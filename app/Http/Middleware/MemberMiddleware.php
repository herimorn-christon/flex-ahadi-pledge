<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth::user()->role=='member') //1=Admin & 0==user
            {
                return $next($request);
            }
            else
            {
                return redirect('admin/dashboard')->with('status','Access Denied !');
            }
        }
        else{
            // if not authenticated
            return redirect('/login')->with('status','Please Login first !');
        }
    }
}
