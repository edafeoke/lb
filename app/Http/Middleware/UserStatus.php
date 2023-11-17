<?php

namespace App\Http\Middleware;

use Closure;

class UserStatus
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
        if (auth()->check() && !auth()->user()->hasRole('admin') && auth()->user()->status =='banned') {
            auth()->logout();
            $message = 'Your account has been banned! Please contact customer service.';
            return redirect('account/login')->with('failed', $message)->with('fail', $message);
        }

        if (auth()->check() && !auth()->user()->hasRole('admin') && auth()->user()->status =='suspended') {
            auth()->logout();
            $message = 'Your account has been suspended! Please contact customer service.';
            return redirect('account/login')->with('failed', $message)->with('fail', $message);
        }

        if (auth()->check() && !auth()->user()->hasRole('admin') && auth()->user()->status =='hold') {
            auth()->logout();
            $message = 'Your account has been placed on hold! Please contact customer service.';
            return redirect('account/login')->with('failed', $message)->with('fail', $message);
        }
        return $next($request);
    }
}
