<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PinVerification
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
        if(! optional($request->user())->hasVerified()){
            return redirect('account/verify-pin');
        }
        return $next($request);
    }
}
