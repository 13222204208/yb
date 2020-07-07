<?php

namespace App\Http\Controllers\Api;

use App\Model\Activity;
use App\Model\UserInfo;
use App\Model\UserDetail;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\UpdatePassRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UploadController;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\UserDetailAuthRequest;

class UserController extends Controller
{
    public $loginAfterSignUp = true;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterAuthRequest $request)
    {   
        $data = $request->all();
        $validator = Validator::make($data, [
            'key' => 'required',
            'regCode' => 'required|captcha_api:' . $request->input('key')
        ]);
        
        if ($validator->fails()) {
            return [
                'code' => 0, 'msg' => '验证码不匹配'
            ];
        } 

     /*    if (!captcha_api_check($request->regCode, $request->key)){
            return response()->json([
                'code' => 0, 'msg' => '验证码不匹配'
            ]);
         } */

        if ($request->register_ip) {
            if(!filter_var($request->register_ip, FILTER_VALIDATE_IP)) {
                $request->register_ip ="错误的ip格式";
            }
        }else{
            $request->register_ip ="无法获取ip";
        }

            $user = new UserInfo;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->register_ip = $request->register_ip;
            $user->register_time = date('Y-m-d H:i:s',time());
            $user->save();

            $detail = new UserDetail;
            $detail->username = $request->username;
            $detail->save();
    
            if ($this->loginAfterSignUp) {
                return $this->login($request);
            } 
    
            return response()->json([
                'code' => 201,
                'msg' =>"注册成功",
                'data' => $user
            ],200);
    }

    public function login(Request $request)
    {         
        $input = $request->only('username', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名或者密码错误',
            ], 200);
        }
        $detail = UserDetail::where('username',$request->username)->first();
        return response()->json([
            'code' => 201,
            'msg' =>"成功",
            'data'=>$detail,
            'token' => $jwt_token,
        ],200);
    }

    
    public function update(UserDetailAuthRequest $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        
        $user = JWTAuth::authenticate($request->token);
        $detail = UserDetail::where('username',$user->username)->first();

            if ($request->true_name) {
                if ($detail->true_name) {
                    return response()->json([
                        'code' => 0,
                        'msg' =>"真实姓名不能修改",
                    ],200);
                }
            }
            
            if ($request->date_brith) {
                if ($detail->date_brith) {
                    return response()->json([
                        'code' => 0,
                        'msg' =>"出生日期不能修改",
                    ],200);
                }
            }

            
            $res = $request->except(['token']);
            $updated = $detail->fill($res)->save();
            
            if ($updated) {
                return response()->json([
                    'code' => 200,
                    'msg' =>"成功",    
                    'data'=>$detail            
                ],200);
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' =>"更改失败",
                ],200);
            }      
        
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'code' => 200,
                'msg' => '用户退出成功'
            ],200);
        } catch (JWTException $exception) {
            return response()->json([
                'code' => 0,
                'msg' => '对不起，用户无法注销'
            ], 200);
        }
    }

    public function newpass(UpdatePassRequest $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        $pass = UserInfo::where('username',$user->username)->first();
    
        if (password_verify($request->password ,$pass->password)) {
            $pass->password = bcrypt($request->newpass);
            $state= $pass->save();
            if ($state) {
                return response()->json([
                    'msg' =>'修改成功',
                    'code' => 200
                ],200);
            }
        }else {
            return response()->json([
                'msg' =>'原始密码不正确',
                'code' => 0
            ],200);
        }
    }

    public function uploadUserHead(Request $request)
    {
        $upload= new UploadController;
        $namePath= $upload->uploadImg($request->file('file'),'UserHeadImg');
        $namePath = 'http://'.$_SERVER['HTTP_HOST'].'/'.$namePath;
        if ($namePath) {
            $this->validate($request, [
                'token' => 'required'
            ]);
    
            $user = JWTAuth::authenticate($request->token);
            if (!$user) {
                return response()->json(['msg' =>'找不到用户', 'code' => 0]);
            }
            UserDetail::where('username',$user->username)->update([
                'user_head'=> $namePath
            ]);
            return response()->json(['user_head' =>$namePath, 'code' => 200,'msg'=>'上传成功']);
        } else {
            return response()->json(['msg' =>'上传失败', 'code' => 0]);
        }    
    }

    public function myActivity(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        $data = Activity::whereDate('created_at','>',$user->register_time)->get(['activity_title',
        'activity_img','activity_describe','activity_sort']);

        
        if ($data->first()) {
            return response()->json( ['msg'=>'成功','data'=>$data,'code'=>200]);
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"无符合条件数据",
            ],200);
        }
    }

    public function regCode()
    { 
        return response()->json([
            'code' => 200,
            'msg' => '创建成功',
            'url' => app('captcha')->create('default', true)
        ]);
    }
 
}
