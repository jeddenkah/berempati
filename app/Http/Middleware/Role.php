<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,... $roles)
    {
        if (Auth::user()) {

            foreach($roles as $role) {
              if (Auth::user()->role->name == $role) {
                return $next($request);
              }
            }
      
            return abort(401);
      
          }
          return abort(401);
    }
}
