<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\isUser as Middleware;
use Illuminate\Support\Facades\Auth;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, String $type) {
    
    if(Auth::check()){
          if(Auth::user()->type == 'User'){
              return $next($request);
          }
          return $next($request);
      }

          return redirect('/login');
  }
}
