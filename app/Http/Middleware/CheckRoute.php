<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoute
{
    /**
     * Handle an incoming request.中间件需要注册到http 内核中.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dump($request->route()->named('hello'));
        if ($request->route()->named('hello')) {
            dump('包含了别名 hello');
        }

        return $next($request);
    }
}
