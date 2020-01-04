<?php

namespace App\Http\Middleware;
use Closure;
use App\User;

class ProfileIfCompleted
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
        $user = $request->user();
        $role = $user->role;
        $userInfo = $user->UserInfo()->first();
        $image = $user->getFirstMediaUrl('avatars');
        
        $isCompleted = true;
        if($role == User::ROLE_BUYER && (!$userInfo || !$userInfo->number)){
             $isCompleted = false; 
        } elseif($role == User::ROLE_GIRL && (!$userInfo || !$userInfo->number || !$image)){
             $isCompleted = false; 
        }

        if($isCompleted == false){
            return redirect('/account/settings/steps');
        }

        return $next($request);
    }
}
