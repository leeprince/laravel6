<?php

namespace LeePrince\WeChat\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckSignture
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
        $signature = $request->input("signature");
        $timestamp = $request->input("timestamp");
        $nonce     = $request->input("nonce");
        $echostr   = $request->input("echostr");
    
        $token  = 'leeprinceSubscription';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
    
        if ($tmpStr == $signature) {
            // 微信服务器在验证业务服务器地址的有效性时，包含 echostr 参数，此后不再包含
            if (empty($echostr)) {
                /**
                 * 开始处理业务
                 */
                return $next($request);
            } else {
                // 若确认此次GET请求来自微信服务器，请原样返回echostr参数内容. 此处只能使用 echo，使用 return 失败。
                return response($echostr);
            }
        } else {
            dump('验证失败');
            Log::error('验证失败');
            response('false');
        }
    }
}
