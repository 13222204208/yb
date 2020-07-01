<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserDetailAuthRequest extends ApiBaseRequest
{
    public function rules()
    {
        return [
            'true_name' => 'regex:/^[\u4E00-\u9FA5]{2,4}$/',
            'email' => 'email',
            'phone' =>'regex:/^1[345789][0-9]{9}$/',
            'date_brith' => 'date',

        ];
    }

    public function messages()
    {  
       return [
            'email.email' => '必须是正确的邮箱',
        ];
    }
}
