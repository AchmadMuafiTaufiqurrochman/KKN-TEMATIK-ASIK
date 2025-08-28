<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }
        
        // Jika request adalah AJAX, berikan response JSON
        if ($request->ajax()) {
            return null;
        }
        
        // Set flash message untuk memberitahu user bahwa session expired
        session()->flash('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
        
        return route('login');
    }
    
    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Sesi Anda telah berakhir. Silakan refresh halaman dan login kembali.',
                'redirect' => route('login')
            ], 401);
        }

        return redirect()->guest(route('login'))
            ->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
    }
}