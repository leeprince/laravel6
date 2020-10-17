<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-09 01:16
 */

namespace LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LeePrince\LaravelWechatShop\Wap\Member\Models\User;
use LeePrince\LaravelWechatShop\Wap\Member\Facades\Member;

class AuthorizationController extends Controller
{
    public function wechatLogin(Request $request)
    {
        $wechatUser = session('wechat.oauth_user.default'); // 拿到授权用户资料
        $user = User::where('weixin_openid', $wechatUser->id)->first();
        // dump($wechatUser);
        
        if (! $user) {
            // 存储为新用户
            $user = User::create([
               'weixin_openid' => $wechatUser->id,
               'nickname' => $wechatUser->name??'',
               'image_head' => $wechatUser->avatar??''
            ]);
        }
        
        // 更新用户状态为已登陆：auth， 通过看守者去改变用户登陆状态
        /*dump(Auth::check());
        Auth::login($user);
        dump(Auth::check());*/
        dump(Auth::guard('prince-wap-member')->check());
        Auth::guard('prince-wap-member')->login($user);
        dump(Auth::guard('prince-wap-member')->check());
        
        // Member 门面已实现守卫者工具， 用于替换以下 Auth::guard('prince-wap-member') 的写法
        dump(Member::guard()->check());
        // 通过 Member 中的魔术方法实现 Member::check() 替换 Member::guard()->check(); 的写法
        dump(Member::check());
        
        // 登陆后重定向
        return '已通过';
        // return redirect()->route('wap.member.index');
        
        
    }
}