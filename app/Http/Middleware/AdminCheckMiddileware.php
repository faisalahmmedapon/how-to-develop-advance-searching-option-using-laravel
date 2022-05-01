<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheckMiddileware
{

    public function handle($request, Closure $next)
    {
        if (!Session()->has('adminId')){
            return redirect('/admin/login')->with('error','please login first');
        }
        return $next($request);
    }
}
