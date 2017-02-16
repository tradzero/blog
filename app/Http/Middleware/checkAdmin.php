<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class checkAdmin
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
        if (Auth::user()->role == User::ROLE_ADMIN) {
            return $next($request);
        }
        return redirect('/');
    }
}
