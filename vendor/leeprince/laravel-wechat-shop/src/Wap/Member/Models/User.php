<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-08 13:27
 */

namespace LeePrince\LaravelWechatShop\Wap\Member\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'sys_users';
    
    protected $fillable = [
        'weixin_openid','nickname','image_head'
    ];
}