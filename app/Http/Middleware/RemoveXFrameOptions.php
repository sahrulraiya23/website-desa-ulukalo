<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveXFrameOptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan request untuk mendapatkan response
        $response = $next($request);

        // Hapus header X-Frame-Options dari semua response
        // Ini aman untuk aplikasi internal seperti ini
        $response->headers->remove('X-Frame-Options');

        return $response;
    }
}
