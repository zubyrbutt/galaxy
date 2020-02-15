<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IpMiddleware
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

        /*FIBERLINKS1 27.255.4.203   
        FIBERLINKS2	27.255.4.50    
        FORTUNES 	124.109.48.193 
        Comsats     203.124.41.82   */
         $whitelistedip=['27.255.4.203', '27.255.4.50', '124.109.48.193', '203.124.41.82'];

         if (!in_array($request->ip(), $whitelistedip) && auth()->user()->role_id!='1') {
             // here instead of checking a single ip address we can do collection of ips
             //address in constant file and check with in_array function            
             return redirect('home');
         }
        return $next($request);
    }


}
