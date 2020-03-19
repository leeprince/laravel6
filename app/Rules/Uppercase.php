<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * 确定验证规则是否通过。
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }
    
    /**
     * 获取验证错误消息。
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 必须是大写';
    }
    
    /**
     * 获取验证错误的自定义属性。
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_name' => '【用户名】- ',
            'password' => '【密码】- ',
        ];
    }
}
