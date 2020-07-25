<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class YBApiController extends Controller
{
    public function __construct(){
        $this->agent = 'by20072101';	//商户编号
        $this->timestamp = time();		//时间戳
        $this->secret_key = "C6ypm6dhenoHFBBU";//商户密钥
        $this->iv = "0102030405060708";//IV向量
        $this->randno = mt_rand(1000000000,9999999999);		//10位随机数
        $md5 = MD5($this->agent.$this->timestamp.$this->secret_key);
        $str = 'ShyAQHp3';
        $str = str_shuffle($str);
        $str1= substr($str , 0 , 2);
        $str2= substr($str , 2 , 2);
        $str3= substr($str , 4 , 2);
        $str4= substr($str , 6 , 2);
        $md5 = substr_replace($md5,$str2,9,0);
        $md5 = substr_replace($md5,$str3,19,0);
        $md5sign= $str1.$md5.$str4;

        $this->sign = $md5sign;				//加密签名档

    }

        /**
     * 组建en json参数数组
     * @param $plainText
     * @param $key
     * @return string
     */
    public function encryptText($data) {
        return base64_encode(openssl_encrypt($data, 'AES-128-CBC',$this->secret_key, OPENSSL_RAW_DATA, $this->iv));
    }

    public function curlData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-type: text/plain"
        ));
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);//执行并获取数据
        curl_close($ch);
    }

    public function launchGame(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->memberId) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['memberId']= $request->memberId;
        $data['memberName']= $request->memberName;
        $data['memberPwd'] = $request->memberPwd;
        $data['deviceType'] = intval($request->deviceType);
        $data['memberIp'] = $request->memberIp;
        $data = json_encode($data);
        $url= $request->url;
        $url=$url."?agent=".$this->agent."&timestamp=".$this->timestamp."&randno=".$this->randno."&sign=".$this->sign;
        $data= $this->encryptText($data);
        $this->curlData($url,$data);

    }

    public function transferIn(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->memberId) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['memberId']= $request->memberId;
        $data['money']= intval($request->money);
        $data['orderId'] = $request->orderId;
        $data['memberName']= $request->memberName;
        $data['memberPwd'] = $request->memberPwd;
        $data['deviceType'] = intval($request->deviceType);
        $data['memberIp'] = $request->memberIp;
        $data = json_encode($data);
        $url= $request->url;
        $url=$url."?agent=".$this->agent."&timestamp=".$this->timestamp."&randno=".$this->randno."&sign=".$this->sign;
        $data= $this->encryptText($data);
        $this->curlData($url,$data);
    }

    public function transferOut(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->memberId) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['orderId'] = $request->orderId;

        $data = json_encode($data);
        $url= $request->url;
        $url=$url."?agent=".$this->agent."&timestamp=".$this->timestamp."&randno=".$this->randno."&sign=".$this->sign;
        $data= $this->encryptText($data);
        $this->curlData($url,$data);
    }

    public function queryBalance(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->memberId) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['memberId']= $request->memberId;
        $data['memberPwd'] = $request->memberPwd;
        $data['memberIp'] = $request->memberIp;
        $data = json_encode($data);
        $url= $request->url;
        $url=$url."?agent=".$this->agent."&timestamp=".$this->timestamp."&randno=".$this->randno."&sign=".$this->sign;
        $data= $this->encryptText($data);
        $this->curlData($url,$data);
    }

    public function updateMemberPwd(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->memberId) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['memberId']= $request->memberId;
        $data['newMemberPwd'] = $request->newMemberPwd;
        $data['oldMemberPwd'] = $request->oldMemberPwd;
        $data = json_encode($data);
        $url= $request->url;
        $url=$url."?agent=".$this->agent."&timestamp=".$this->timestamp."&randno=".$this->randno."&sign=".$this->sign;
        $data= $this->encryptText($data);
        $this->curlData($url,$data);
    }

    public function gameList(Request $request)
    {
        $url= $request->url;
        $url=$url."?agent=".$this->agent."&timestamp=".$this->timestamp."&randno=".$this->randno."&sign=".$this->sign;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-type: text/plain"
        ));
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求
        curl_exec($ch);//执行并获取数据
        curl_close($ch);

    }
}
