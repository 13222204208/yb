<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackRequest extends ApiBaseRequest
{
    public function rules()
    {
        return [
            'token'=> 'required',
            'feedback_type' => 'required|min:2|max:20',//只允许数字和字母
            'feedback_content' => 'required|min:20|max:200',
        ];
    }
}
