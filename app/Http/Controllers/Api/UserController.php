<?php

namespace App\Http\Controllers\Api;

use App\Model\UserInfo;
use App\Model\UserDetail;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
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

    
    public function update(UserDetailAuthRequest $request,$username)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        
        $user = JWTAuth::authenticate($request->token);

        if ($user->username == $username) {
            $detail = UserDetail::where('username',$username)->first();

            if ($request->true_name) {
                if ($detail->true_name) {
                    return response()->json([
                        'code' => 0,
                        'msg' =>"真实姓名不能修改",
                    ],200);
                }
            }
            
            if ($request->gender) {
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
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"用户名不匹配",
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
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user->username]);
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
 
}
