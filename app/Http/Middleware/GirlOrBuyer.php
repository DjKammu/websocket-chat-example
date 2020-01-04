<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use App\User;
use Carbon\Carbon;

class GirlOrBuyer
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
        if(\Auth::guest())
            return $next($request);

        $user = $request->user();
        $role = $user->role;

        if($role == \App\User::ROLE_BUYER && Route::currentRouteName() != 'girls'
                &&  \Request::is('girls/*') == false){
             return redirect('girls');
        }

        if($role == \App\User::ROLE_GIRL && Route::currentRouteName() != 'account'){
             return redirect('account');
        }

        return $next($request);
    }
}
