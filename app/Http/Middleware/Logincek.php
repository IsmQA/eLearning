<?php

namespace App\Http\Middleware;

use Closure;

class Logincek
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
        if(session('cekLogin') == true){
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
