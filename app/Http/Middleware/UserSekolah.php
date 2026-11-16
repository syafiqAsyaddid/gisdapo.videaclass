<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserSekolah
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

        if (!auth()->user()->sekolah_id) {
            abort(403);
        }


        return $next($request);
    }
}
