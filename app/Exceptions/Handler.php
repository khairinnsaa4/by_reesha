<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // Tangani sesi kedaluwarsa (419 TokenMismatchException) secara anggun
        $this->renderable(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->is('logout') || $request->is('*/logout')) {
                \Illuminate\Support\Facades\Auth::logout();
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
    }
}
