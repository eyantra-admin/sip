<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\User;

class CheckIfStudent
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
        $user = User::where(['email' => $request->user()->email])->first(['role','active']);
        if(($user->role === 1 || $user->role === 4) && $user->active === 1) {
            return $next($request);
        }
        else {
            //return response()->json(['error' => 'Unauthorized'], 403);
            return redirect()->route('keycloak.logout');
        }
    }
}