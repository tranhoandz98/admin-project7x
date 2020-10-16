<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class checkAdmin
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
        if (Auth::check()){
            if (Auth::user()->status == 1){
                return $next($request);
            }
            else{
                return redirect('/admin/login')->with('errors' , 'Tài khoản đã khóa');;
            }
        }
        return redirect('/admin/login');
    }
}
