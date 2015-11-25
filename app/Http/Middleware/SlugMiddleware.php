<?php namespace Penst\Http\Middleware;

use Closure, Config;
use Illuminate\Contracts\Auth\Guard;

class SlugMiddleware  {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->segment(2) === 'admin') {
            Config::set("is_admin", true);
        }
        else {
            Config::set("is_admin", false);
        }

        return $next($request);
    }
}