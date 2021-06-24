<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
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
        if(  Auth::check() ) 
        {
            $user=Auth::user();
            // if user is not admin take him to his dashboard
            if ( $user->role == 'employe')  {
                 return redirect(route('dashboard'));
            }
            // allow admin to proceed with request
            else if (  $user->role == 'manager' ) {
                 return redirect(route('dashboard'));
            }
            else{
                return $next($request);
            }
        }
    }
}
