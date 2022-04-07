<?php

namespace App\Http\Middleware\Akses;

use Closure;
use Illuminate\Http\Request;

class LevelAdminMiddleware
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
        if (auth()->check() && auth()->user()->level_admin) {
            return $next($request);
        }
        return abort(403);
    }
}
