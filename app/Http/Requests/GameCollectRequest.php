<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiBaseRequest;

class GameCollectRequest extends ApiBaseRequest
{
    /**
     * 获取应用于请求的验证规则
     *
     *
     */
    public function rules()
    {
        return [
            'productType' => 'required|max:20',
            'tcgGameCode' => 'required|max:20',
            'productCode' => 'required|max:20',
            'gameName' => 'required|max:30',
            'token' => 'required',
        ];
    }

    public function messages()
    {
       return [
            'token.required' => '必须填写token',
        ];
    }
}
