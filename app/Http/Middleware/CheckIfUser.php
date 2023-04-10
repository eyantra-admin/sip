<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\User;

class CheckIfUser
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
        if(!User::where(['email' => $request->user()->email])->exists()){
            return redirect()->route('keycloak.logout');            
        }

        return $next($request);
    }
}