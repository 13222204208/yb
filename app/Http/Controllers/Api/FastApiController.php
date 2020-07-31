<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class FastApiController extends Controller
{

    public function curlData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);//执行并获取数据
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
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function login(Request $request)
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
        $data['GameCode'] = $request->GameCode;
        $data['UserIP'] =  $request->UserIP;
        $data['DeviceType']= intval($request->DeviceType);
        $data['IsTrial'] = intval($request->IsTrial);
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function balance(Request $request)
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
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function transfer(Request $request)
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
        $data['TransType'] = $request->TransType;
        $data['Amount'] = $request->Amount;
        $data['OrderNo'] = $request->OrderNo;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function checkTransfer(Request $request)
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
        $data['OrderNo'] = $request->OrderNo;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $this->curlData($url,$data);

    }
}
