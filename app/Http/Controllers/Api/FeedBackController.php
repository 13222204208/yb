<?php

namespace App\Http\Controllers\Api;

use App\Model\Feedback;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\FeedBackRequest;
use App\Http\Controllers\UploadController;

class FeedBackController extends Controller
{
    public function feedback(FeedBackRequest $request)
    {
        $user = JWTAuth::authenticate($request->token);
        $feedback = new Feedback;
        $feedback->username = $user->username;
        $feedback->feedback_type = $request->feedback_type;
        $feedback->content = $request->content;
        if ($request->img_url) {
            $upload= new UploadController;
            $namePath= $upload->uploadImg($request->file('img_url'),'FeedBackImg');
            if (!$namePath) {
                return response()->json(['msg' =>'图片上传失败', 'code' => 0]);
            }
            $img_url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$namePath;
            $feedback->img_url= $img_url;
        }

        $state= $feedback->save();

        if ($state) {
            return response()->json(['code' => 200,'msg'=>'成功']);
        } else {
            return response()->json(['msg' =>'失败', 'code' => 0]);
        }   
    }
}
