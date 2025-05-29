<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPKLAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika bukan siswa, lanjutkan
        if (auth()->user()->role !== 'siswa') {
            return $next($request);
        }

        // Jika siswa belum terdaftar atau tidak memiliki relasi
        if (!auth()->user()->siswa) {
            abort(403, 'Anda belum terdaftar sebagai siswa');
        }

        // Jika sudah memiliki PKL
        if (auth()->user()->siswa->pkl) {
            return redirect()->route('pkl')
                ->with('error', 'Anda sudah membuat laporan PKL sebelumnya');
        }

        return $next($request);
    }
}