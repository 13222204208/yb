<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class FastApiController extends Controller
{
    public function curl_post_https($url,$jsonStr){ // 模拟提交数据函数
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr)
            )
        );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return response()->json($response);
        return array($httpCode, $response);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $this->curl_post_https($request->url,$data);
    }
}
