<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
        // 前置中间件
        // dump($request->input()['dd']);
        // dd($request->dd);
        if ($request->age < 18) {
            dump('我是前置中间件');
            // return redirect('mindex');
        }
        return $next($request);


        // 后置中间件
        /*$response = $next($request);

        dump('我是后置中间件');
        return $response;*/
    }
}
