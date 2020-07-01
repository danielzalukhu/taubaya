<?php

namespace App\Http\Middleware;

use Closure;

class RoleCheck
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
        $user = \App\User::where('email', $request->session()->get('session_user_email'))->first();
        
        if($user->ROLE === "PARENT"){
            return redirect('/');
        } 
        elseif($user->ROLE === "STUDENT") {
            return redirect('/');
        }

        return $next($request);
    }
}
