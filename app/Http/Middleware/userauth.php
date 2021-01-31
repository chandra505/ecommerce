<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\usercontroller;
use Illuminate\Http\Request;


class userauth
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
        if($request->path()=="login" && $request->session()->has("user")){
            return redirect('/');
        }
        return $next($request);
    }
}
