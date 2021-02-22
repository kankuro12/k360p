<?php

namespace App\Http\Middleware;

use Closure;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('xpsu',-1)!=env('xpsu',123456)){
            return response()->json(['Api Key Not Found'],401);
        }
        return $next($request);
    }
}
