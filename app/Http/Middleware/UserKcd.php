<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserKcd
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

        if (!auth()->user()) {
            abort(403);
        }

        if (auth()->user()->hak_akses_id < 3) {
            abort(403);
        }
        return $next($request);
    }
}
