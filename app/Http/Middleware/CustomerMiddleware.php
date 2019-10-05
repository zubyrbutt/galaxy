<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CustomerMiddleware
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

        $id = Auth::user()->iscustomer;
        if ($id==0) {
            return redirect()->route('dashboard');
        }else if ($id==1) {
             dd('customer');
        }
        //return $next($request);
    }
}
