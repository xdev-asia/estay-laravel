<?php

namespace App\Http\Middleware;

use Closure;

class InstallMiddleware
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
        $condition = env('INSTALLED', false);
        $url = $request->path();
        $cond = (strpos($url, 'install') !== false);
        if($condition && !$cond){
            return $next($request);
        }else if($condition && $cond){
            return redirect('/');
        }else if(!$condition && !$cond){
            return redirect('install');
        }
        return $next($request);
    }
}
