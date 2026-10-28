<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (TokenMismatchException $e, $request) {
            if ($request->is('logout') || $request->is('*/logout')) {
                Auth::logout();
                return redirect('/');
            }
            if ($request->is('login') || $request->is('*/login')) {
                return redirect('/login')->with('error', 'Sesi login Anda telah diperbarui. Silakan masuk kembali.');
            }
            if ($request->is('register') || $request->is('*/register')) {
                return redirect('/register')->with('error', 'Sesi formulir telah diperbarui. Silakan daftar kembali.');
            }
            return redirect()->back()->with('error', 'Sesi Anda telah diperbarui. Silakan ulangi tindakan Anda.');
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Halaman tidak ditemukan.'], 404);
            }
            if (Auth::check()) {
                $user = Auth::user();
                if ($user->role === 'owner') {
                    return redirect('/dashboard-owner');
                }
                if ($user->role === 'karyawan') {
                    return redirect('/pemesanan');
                }
                return redirect('/riwayat-transaksi');
            }
            return redirect('/');
        });

        $this->renderable(function (Throwable $e, $request) {
            if (!config('app.debug') && !$request->expectsJson() && !$this->isHttpException($e)) {
                if (Auth::check()) {
                    $user = Auth::user();
                    if ($user->role === 'owner') {
                        return redirect('/dashboard-owner')->with('error', 'Terjadi kendala sistem, dialihkan kembali ke Dashboard.');
                    }
                    if ($user->role === 'karyawan') {
                        return redirect('/pemesanan')->with('error', 'Terjadi kendala sistem, dialihkan kembali ke Pemesanan.');
                    }
                }
                return redirect('/')->with('error', 'Terjadi kendala sistem, dialihkan kembali ke Beranda.');
            }
        });
    }
}
