<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class YBCPApiController extends Controller
{
    public $merchant= "byyl";
    public $signKey= "94D5BD8FCF4940CD";
    public function curlData($url,$data,$type)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER,$type);
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);//执行并获取数据
        curl_close($ch);
    }

    public function memberCreate(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();
        $data['member']= $request->member;
        $data['memberType'] = $request->memberType;
        $data['password'] = $request->password;
        $data['merchant'] = $this->merchant;
        $data['doubleList'] = "";
        $data['normalList'] = "";
        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('doubleList'.'member'.$data['member'].'memberType'.$data['memberType'].
        'merchant'.$data['merchant'].'normalList'.$data['normalList'].'password'.$data['password'].
                        'timestamp'.$data['timestamp'].$this->signKey);

        $type= array("Content-Type:application/json","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        //return http_build_query($data);
        $this->curlData($url,json_encode($data),$type);
    }

    public function memberLogin(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();
        $data['member']= $request->member;
        $data['password'] = $request->password;
        $data['merchant'] = $this->merchant;
        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('member'.$data['member'].
        'merchant'.$data['merchant'].'password'.$data['password'].
                        'timestamp'.$data['timestamp'].$this->signKey);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        $this->curlData($url,http_build_query($data),$type);
    }

    public function transferBalance(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();
        $data['amount']= $request->amount;
        $data['member']= $request->member;
        $data['transferType'] = $request->transferType;
        $data['merchantAccount'] = $this->merchant;
        $data['notifyId']= $request->notifyId;
        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('amount'.$data['amount'].'member'.$data['member'].
        'merchantAccount'.$data['merchantAccount'].'notifyId'.$data['notifyId'].'transferType'.$data['transferType'].
                        'timestamp'.$data['timestamp'].$this->signKey);

        $type= array("Content-Type:application/ json","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        $this->curlData($url,json_encode($data),$type);
    }
}
