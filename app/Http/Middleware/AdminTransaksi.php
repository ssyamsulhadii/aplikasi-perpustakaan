<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminTransaksi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->level == 'admin') {
            return $next($request);
        }
        if (auth()->check() && auth()->user()->level == 'admintransaksi') {
            return $next($request);
        }
        abort(403);
    }
}
