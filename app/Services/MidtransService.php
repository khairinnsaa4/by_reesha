<?php

namespace App\Services;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected string $serverKey;
    protected string $clientKey;
    protected string $merchantId;
    protected string $apiUrl;
    protected bool $isProduction;

    public function __construct()
    {
        $this->serverKey    = (string) config('midtrans.server_key', '');
        $this->clientKey    = (string) config('midtrans.client_key', '');
        $this->merchantId   = (string) config('midtrans.merchant_id', '');
        $this->isProduction = (bool) config('midtrans.is_production', false);
        $this->apiUrl       = config('midtrans.api_url', 'https://api.sandbox.midtrans.com');
    }

    /**
     * Cek apakah kredensial Midtrans sudah diset di .env
     */
    public function isConfigured(): bool
    {
        return !empty($this->serverKey);
    }

    /**
     * Core API: Generate QRIS Charge langsung dari Midtrans
     *
     * @param Transaksi $trx
     * @return array
     */
    public function createQrisCharge(Transaksi $trx): array
    {
        if (!$this->isConfigured()) {
            return [
                'success' => false,
                'message' => 'Server Key Midtrans belum dikonfigurasi pada file .env (MIDTRANS_SERVER_KEY).',
            ];
        }

        $orderId = $trx->kode_transaksi ?: ('TRX-' . date('Ymd') . '-' . $trx->id);
        $grossAmount = (int) $trx->total_harga;

        // Rincian item details harus bernilai sama dengan total gross_amount
        $itemDetails = [];
        $subtotal = (int) ($trx->harga_satuan * $trx->qty);
        $itemDetails[] = [
            'id'       => 'PROD-' . ($trx->produk_id ?: $trx->id),
            'price'    => (int) $trx->harga_satuan,
            'quantity' => (int) $trx->qty,
            'name'     => mb_substr($trx->nama_produk, 0, 50),
        ];

        $selisih = $grossAmount - $subtotal;
        if ($selisih > 0) {
            $itemDetails[] = [
                'id'       => 'FEES',
                'price'    => $selisih,
                'quantity' => 1,
                'name'     => 'Ongkos Kirim & Biaya Layanan',
            ];
        }

        $customerDetails = [
            'first_name' => $trx->user->name ?? 'Pelanggan By.Reesha',
            'email'      => $trx->user->email ?? 'pelanggan@byreesha.local',
            'phone'      => $trx->user->phone ?? '08123456789',
        ];

        $payload = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details'     => $itemDetails,
            'customer_details' => $customerDetails,
            'qris' => [
                'acquirer' => 'gopay',
            ],
            'custom_expiry' => [
                'order_time'      => now()->format('Y-m-d H:i:s O'),
                'expiry_duration' => 15,
                'unit'            => 'minute',
            ],
        ];

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            ])->post($this->apiUrl . '/v2/charge', $payload);

            $data = $response->json();

            if ($response->successful() && isset($data['status_code']) && in_array($data['status_code'], ['201', '200'])) {
                // Ambil URL QR code dari actions
                $qrUrl = null;
                if (!empty($data['actions']) && is_array($data['actions'])) {
                    foreach ($data['actions'] as $action) {
                        if (isset($action['name']) && $action['name'] === 'generate-qr-code') {
                            $qrUrl = $action['url'];
                            break;
                        }
                    }
                }

                $qrString = $data['qr_string'] ?? null;
                $txId     = $data['transaction_id'] ?? null;
                $expiry   = isset($data['expiry_time'])
                    ? \Carbon\Carbon::parse($data['expiry_time'])
                    : now()->addMinutes(15);

                return [
                    'success'        => true,
                    'qr_url'         => $qrUrl,
                    'qr_string'      => $qrString,
                    'transaction_id' => $txId,
                    'expired_at'     => $expiry,
                    'data'           => $data,
                ];
            }

            Log::error('Midtrans QRIS Charge Error: ', ['response' => $data]);
            $msg = $data['status_message'] ?? 'Terjadi kesalahan saat membuat QRIS di Midtrans.';
            return [
                'success' => false,
                'message' => $msg,
                'data'    => $data,
            ];

        } catch (\Throwable $e) {
            Log::error('Midtrans Connection Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Koneksi ke Midtrans gagal: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Cek status pembayaran ke server Midtrans (GET /v2/{order_id}/status)
     *
     * @param string $orderId
     * @return array
     */
    public function checkStatus(string $orderId): array
    {
        if (!$this->isConfigured()) {
            return ['success' => false, 'message' => 'Server Key belum diset.'];
        }

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Accept'        => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
            ])->get($this->apiUrl . '/v2/' . $orderId . '/status');

            $data = $response->json();

            if ($response->successful() && isset($data['status_code'])) {
                return [
                    'success'            => true,
                    'transaction_status' => $data['transaction_status'] ?? 'unknown',
                    'fraud_status'       => $data['fraud_status'] ?? null,
                    'payment_type'       => $data['payment_type'] ?? null,
                    'settlement_time'    => $data['settlement_time'] ?? null,
                    'data'               => $data,
                ];
            }

            return [
                'success' => false,
                'message' => $data['status_message'] ?? 'Status transaksi tidak ditemukan.',
                'data'    => $data,
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Gagal menghubungi Midtrans: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Verifikasi signature hash notifikasi webhook Midtrans
     * Formula: SHA512(order_id + status_code + gross_amount + ServerKey)
     */
    public function verifySignature(string $orderId, string $statusCode, string $grossAmount, string $signatureKey): bool
    {
        $calculatedHash = hash('sha512', $orderId . $statusCode . $grossAmount . $this->serverKey);
        return hash_equals($calculatedHash, $signatureKey);
    }
}
