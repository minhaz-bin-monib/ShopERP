<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedInCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Keep session key consistent with AuthController (loginId/loginRole)
        if ($request->session()->has('loginId')) {
            if ($request->is('login') || $request->is('/')) {
                return redirect('/dashboard');
            }
        }
        return $next($request);
    }
}
