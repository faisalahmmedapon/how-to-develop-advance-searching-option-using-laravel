<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheckLoginMiddileware
{

    public function handle($request, Closure $next)
    {
        if (Session()->has('adminId') && (url('/admin/login') == $request->url() || url('/admin/register') == $request->url() )){
            return back();
        }
        return $next($request);
    }
}
