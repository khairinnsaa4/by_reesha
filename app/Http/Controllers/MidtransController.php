<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    protected MidtransService $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    /**
     * Webhook Handler: Menerima notifikasi otomatis dari Midtrans (HTTP Notification)
     * URL Callback: POST /api/midtrans-callback
     */
    public function handleNotification(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook Received: ', $payload);

        $orderId           = $payload['order_id'] ?? null;
        $statusCode        = $payload['status_code'] ?? null;
        $grossAmount       = $payload['gross_amount'] ?? null;
        $signatureKey      = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus       = $payload['fraud_status'] ?? null;

        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            return response()->json(['message' => 'Payload tidak lengkap.'], 400);
        }

        // Verifikasi Signature Hash keamanan
        if (!$this->midtrans->verifySignature($orderId, $statusCode, $grossAmount, $signatureKey)) {
            Log::warning('Midtrans Webhook: Invalid Signature Hash for order ' . $orderId);
            return response()->json(['message' => 'Invalid signature.'], 403);
        }

        $trx = Transaksi::where('kode_transaksi', $orderId)->first();
        if (!$trx) {
            Log::warning('Midtrans Webhook: Transaksi tidak ditemukan untuk order_id ' . $orderId);
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        DB::transaction(function () use ($trx, $transactionStatus, $fraudStatus, $payload) {
            $trx = Transaksi::lockForUpdate()->find($trx->id);

            if (isset($payload['transaction_id'])) {
                $trx->midtrans_transaction_id = $payload['transaction_id'];
            }

            if ($transactionStatus === 'capture') {
                if ($fraudStatus === 'challenge') {
                    $trx->payment_status = 'challenge';
                } else if ($fraudStatus === 'accept') {
                    $trx->payment_status = 'settlement';
                    $trx->status = 'Diproses';
                }
            } elseif ($transactionStatus === 'settlement') {
                $trx->payment_status = 'settlement';
                $trx->status = 'Diproses'; // Lunas, masuk antrean pesanan
            } elseif ($transactionStatus === 'pending') {
                $trx->payment_status = 'pending';
                if ($trx->status !== 'Diproses') {
                    $trx->status = 'Menunggu Pembayaran';
                }
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $oldStatus = $trx->status;
                $trx->payment_status = $transactionStatus;
                $trx->status = 'Dibatalkan';

                // Kembalikan stok kuota produk jika pesanan expired atau dibatalkan
                if (!in_array($oldStatus, ['Dibatalkan', 'Batal'])) {
                    $p = $trx->produk_id ? Produk::find($trx->produk_id) : Produk::where('nama_kue', $trx->nama_produk)->first();
                    if ($p) {
                        $p->increment('stock', $trx->qty);
                        $p->increment('stok', $trx->qty);
                        if ($p->sold_count >= $trx->qty) {
                            $p->decrement('sold_count', $trx->qty);
                        }
                    }
                }
            }

            $trx->save();
        });

        return response()->json(['status' => 'success', 'message' => 'Notifikasi berhasil diproses.']);
    }

    /**
     * Polling / Pengecekan status pembayaran seketika oleh frontend
     * URL: GET /transaksi/{id}/cek-status
     */
    public function checkStatus($id)
    {
        $trx = Transaksi::findOrFail($id);

        // Jika di DB lokal sudah lunas, langsung return success
        $isPaid = in_array($trx->payment_status, ['settlement', 'capture']) 
            || in_array($trx->status, ['Diproses', 'Dikemas', 'Dikirim', 'Selesai']);

        if ($isPaid) {
            return response()->json([
                'paid'           => true,
                'status'         => $trx->status,
                'payment_status' => $trx->payment_status,
                'message'        => 'Pembayaran telah berhasil diterima!',
            ]);
        }

        // Jika belum lunas dan ada kode_transaksi, coba sync langsung ke Midtrans API
        if ($trx->kode_transaksi && $this->midtrans->isConfigured()) {
            $midtransCheck = $this->midtrans->checkStatus($trx->kode_transaksi);
            if ($midtransCheck['success']) {
                $txStatus = $midtransCheck['transaction_status'];
                if (in_array($txStatus, ['settlement', 'capture'])) {
                    $trx->payment_status = 'settlement';
                    $trx->status = 'Diproses';
                    $trx->save();

                    return response()->json([
                        'paid'           => true,
                        'status'         => $trx->status,
                        'payment_status' => $trx->payment_status,
                        'message'        => 'Pembayaran terkonfirmasi lunas dari Midtrans!',
                    ]);
                } elseif (in_array($txStatus, ['expire', 'cancel', 'deny'])) {
                    if ($trx->status !== 'Dibatalkan') {
                        $p = $trx->produk_id ? Produk::find($trx->produk_id) : Produk::where('nama_kue', $trx->nama_produk)->first();
                        if ($p) {
                            $p->increment('stock', $trx->qty);
                            $p->increment('stok', $trx->qty);
                            if ($p->sold_count >= $trx->qty) {
                                $p->decrement('sold_count', $trx->qty);
                            }
                        }
                    }
                    $trx->payment_status = $txStatus;
                    $trx->status = 'Dibatalkan';
                    $trx->save();

                    return response()->json([
                        'paid'           => false,
                        'expired'        => true,
                        'status'         => $trx->status,
                        'payment_status' => $trx->payment_status,
                        'message'        => 'Waktu pembayaran QRIS telah kedaluwarsa atau dibatalkan.',
                    ]);
                }
            }
        }

        return response()->json([
            'paid'           => false,
            'status'         => $trx->status,
            'payment_status' => $trx->payment_status ?? 'unpaid',
            'expired_at'     => $trx->expired_at ? $trx->expired_at->toIso8601String() : null,
        ]);
    }
}
