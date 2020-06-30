<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
{
    /**
     * 确定是否授权用户发出此请求
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 获取应用于请求的验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:f_userinfo|min:4|max:12|alpha_num',//只允许数字和字母
            'password' => 'required|min:6|max:12|alpha_num',
        ];
    }
}