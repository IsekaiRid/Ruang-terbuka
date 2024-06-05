<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekUserSosial
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->route()->getName() !== 'loginpage') {
                return redirect()->route('loginpage');
            }
        }
        $Role = Auth::user()->role;

        if ($Role == '1') {
            return $next($request);
        } elseif ($Role == '2') {
            return $next($request);
        } else {
            return redirect()->route('loginpage')->with('gagal', 'Anda tidak punya akses');
        }
    }
}
