<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class OwnerMiddleware
{
    protected $user;

    public function __construct(Guard $auth){

        $this->user = $auth->user();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->isOwner()){
                $this->setTimeZone($request);
                return $this->addTimeZoneCookie($request, $next($request));
            }
            if(Auth::user()->role_id == 2) {
                Auth::logout();
                Session::flash('activationWarning', true);
                return redirect()->route('login'); 
            }
        }
        return redirect(404);
    }

    public function setTimeZone($request){

        if($this->user) {
            return date_default_timezone_set($this->user->timezone ? $this->user->timezone : Config::get('app.timezone'));
        }

        $timeZone = $request->cookie('time_zone');

        if($timeZone) {
            return date_default_timezone_set($timeZone);
        }
        return;
    }

    public function addTimeZoneCookie($request, $response)
    {
        if(! $request->cookie('time_zone') && ! is_null($this->user))
        {
            return $response->withCookie(cookie('time_zone', $this->user->timezone, 120));
        }
        return $response;
    }
}
