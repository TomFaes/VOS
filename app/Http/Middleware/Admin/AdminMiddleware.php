<?php

namespace App\Http\Middleware\Admin;
use Closure;

class AdminMiddleware
{
    /**
     * Will determen if a user can manipulate a resource
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $user = $request->user('api');
        if(isset($user) === true){
            foreach(explode('|', $roles) as $role){
                if($user->typeAccount->Name == $role){
                    return $next($request);
                }
            }
        }
        return response()->json("De gebruiker heeft geen rechten om dit aan te passen", 200);
    }
}
