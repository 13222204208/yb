<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class TCApiController extends Controller
{
    public function __construct(){
        $this->url = 'http://www.connect6play.com/doBusiness.do';					//API 连接
        $this->merchant_code = 'byylcny';		//代理商号
        $this->desKey = 'ZADKwrWZ';				//加密金钥
        $this->signKey = 'tw3947BNYH3Y1pn9';				//加密签名档
        $this->currency = 'CNY'; 						//币别
        $this->product_type = 2;//游戏产品代码 代表彩票
    }

    public function curlData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-type: application/x-www-form-urlencoded;charset=UTF-8"
        ));
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_exec($ch);//执行并获取数据
    }

    /**
     * 组建en json参数数组
     * @param $plainText
     * @param $key
     * @return string
     */
    public function encryptText($plainText, $key) {;

        $encText= openssl_encrypt($plainText,'DES-ECB',$key,OPENSSL_RAW_DATA);
        return base64_encode($encText);
    }


    public function pkcs5_pad ($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }


    public function send_require($sendParams){
        $params =  $this->encryptText(json_encode($sendParams),$this->desKey);

        $sd = $params.$this->signKey;//echo $sd;exit;

        $sign = hash('sha256', $sd);//echo $sign;exit;

        $data = array('merchant_code' => $this->merchant_code, 'params' => $params , 'sign' => $sign);

        $this->curlData($this->url,$data);

    }


    public function CRegister(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method']= "cm";
        $data['username']= $request->username;
        $data['password']= $request->password;
        $data['currency']= $this->currency;

        $result = $this->send_require($data);
        return $result;
    }

    public function gameList(Request $request)
    {
        $data = array();
        $data['method']= "tgl";
        $data['language']= "ZH_CN";
        $data['product_type']= $this->product_type;
        $data['platform']= $request->platform;
        $data['client_type'] = $request->client_type;
        $data['game_type'] = $request->game_type;
        if ($request->page) {
            $data['page'] = $request->page;
        }
        if ($request->page_size) {
            $data['page_size']= $request->page_size;
        }

        $result = $this->send_require($data);
        return $result;

    }

    public function launchGame(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method']= "lg";
        $data['username']= $request->username;
        $data['product_type']= $this->product_type;
        if ($request->platform) {
            $data['platform'] = $request->platform;
        }
        $data['game_mode'] = $request->game_mode;
        $data['game_code'] = $request->game_code;

        if ($request->view) {
            $data['view']= $request->view;
        }

        if ($request->back_url) {
            $data['back_url']= $request->back_url;
        }

        if ($request->lottery_bet_mode) {
            $data['lottery_bet_mode']=$request->lottery_bet_mode;
        }

        if ($request->language) {
            $data['language'] = $request->language;
        }

        if ($request->series) {
            $data['series']= json_encode($request->series);
        }
        return $request->series;
        $result = $this->send_require($data);
        return $result;
    }
}
