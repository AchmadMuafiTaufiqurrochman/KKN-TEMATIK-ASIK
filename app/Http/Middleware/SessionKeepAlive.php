<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionKeepAlive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login, refresh session lifetime
        if (Auth::check()) {
            // Regenerate session untuk mencegah session fixation
            if (!$request->session()->has('last_regenerated') || 
                time() - $request->session()->get('last_regenerated') > 1800) { // 30 menit
                $request->session()->regenerate();
                $request->session()->put('last_regenerated', time());
            }
            
            // Update last activity timestamp
            $request->session()->put('last_activity', time());
        }

        $response = $next($request);

        // Jika response adalah 403 atau 404 dan user seharusnya login, redirect ke login
        if (in_array($response->getStatusCode(), [403, 404]) && Auth::guest() && $request->expectsJson() === false) {
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
        }

        return $response;
    }
}
