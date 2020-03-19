<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $redirect = 'error';
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // return [
        //     'user_name' => 'required|max:255|min:5',
        //     'password' => 'required|max:255|min:2',
        // ];
        // return [
        //     'user_name' => ['required', 'max:255', 'min:5'],
        //     'password' => ['required', 'max:255', 'min:2'],
        // ];
        // 自定义验证规则
        return [
            'user_name' => ['required', 'max:255', 'min:5', new Uppercase],
            'password' => ['required', 'max:255', 'min:2'],
        ];
    }
    
    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        // return [
        //     'user_name.required' => '用户名是必填项',
        //     'password.required'  => '密码是必填项',
        // ];
    
        return [
            'user_name.required' => ':attribute 是必填项',
            'password.required'  => ':attribute 是必填项'
        ];
    }
    
    /**
     * 获取验证错误的自定义属性。
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_name' => '【用户名】',
            'password' => '【密码】',
        ];
    }
    
}
