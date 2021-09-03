<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BelumLogin
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
        if (!session()->has('token')) {
            return $next($request);
        } else {
            return redirect("app-admin/dashboard")->with("message", "Selamat Datang!!!");
        }
    }
}
