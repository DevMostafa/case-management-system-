<?php

namespace App\Http\Middleware;

use Closure;

class RoleGate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role1)
    {
        
       if($request->user() == null)
       {
        return redirect()->back()->withErrors(['error'=>'Insufficient Permission']);
       }
        //for admin
        
        if($request->user()->role->slug=='admin')
        {
            return $next($request);
        }

        if ($request->user() && $request->user()->role && $request->user()->role->slug === $role1) {
            return $next($request);
         }
        return redirect('/login');
    }
}
