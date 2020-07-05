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
        $feedback->feedback_content = $request->feedback_content;
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

    public function myFeedback(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        $data = Feedback::where('username',$user->username)->get(['username','feedback_type','feedback_content','img_url','state','created_at']);
        if ($data) {
            return response()->json($data,200);
        }else {
            return response()->json(['msg' =>'无数据', 'code' => 0]);
        }  
        
    }
}
