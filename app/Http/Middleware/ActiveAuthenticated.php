<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveAuthenticated
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
            if ( $user->admin_action == '1')  {
                return $next($request);
            }
            else{

                if ($user->admin_action == '2') {

                    Auth::guard('web')->logout();

                    $request->session()->invalidate();
            
                    $request->session()->regenerateToken();
                    
                    return redirect(route('infoNotice'));
                } else {
                    
                    Auth::guard('web')->logout();
    
                    $request->session()->invalidate();
            
                    $request->session()->regenerateToken();
                    
                    return redirect(route('notice'));
                }
                

                
            }
        }
    
    }
}
