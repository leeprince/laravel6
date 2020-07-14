<?php

namespace LeePrince\WeChat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * [微信公众号 - 订阅号接受微信服务验证、接受微信从订阅号发送过来的信息并自动回复]
 *
 * @Author  leeprince:2020-03-22 20:06
 * @package LeePrince\WeChat\Http\Controllers
 */
class WxSubscriptionController extends Controller
{
    /**
     * [自动回复微信公众号信息]
     *
     * @Author  leeprince:2020-03-24 01:10
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * 开始处理业务
         */
        // 回复信息
        // 接收微信发送的参数
        $postObj =file_get_contents('php://input');
        $postArr = simplexml_load_string($postObj,"SimpleXMLElement",LIBXML_NOCDATA);
        if (empty($postArr)) {
            Log::error('XML消息为空');
            return response('XML消息为空！');
        }
        //消息内容
        $content = $postArr->Content;
        //接受者
        $toUserName = $postArr->ToUserName;
        //发送者
        $fromUserName = $postArr->FromUserName;
        //获取时间戳
        $time = time();
        
        //回复消息内容； 补充：想更加只能可以通过接入机器人自动回复。比如图灵机器人：http://www.tuling123.com
        $content = "[PrinceProgramming] - 编程是一门艺术\n欢迎您，您的消息是： $content\n";
        //回复文本消息的格式：把百分号（%）符号替换成一个作为参数进行传递的变量
        $info = sprintf(config('leeprince-wechat.wechat_template.text'), $fromUserName, $toUserName, $time, $content);
    
        return response($info);
    }
}



