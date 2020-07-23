<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TCApiController extends Controller
{
    public $desKey = 'ZADKwrWZ';
    public $merchant_code = 'byylcny';
    public $signkey = 'tw3947BNYH3Y1pn9';
    public $url = 'http://www.connect6play.com/doBusiness.do';

    function encryptText($input, $key)
    {
        $ivlen = openssl_cipher_iv_length('DES-ECB');    // 获取密码iv长度
        $iv = openssl_random_pseudo_bytes($ivlen);        // 生成一个伪随机字节串
        $data = openssl_encrypt($input, 'DES-ECB', $key, $options=OPENSSL_RAW_DATA, $iv);    // 加密
        return bin2hex($data);
    }

    public function send_require($sendParams){
        $params =  $this->encryptText(json_encode($sendParams),$this->desKey);//echo $this->signkey; exit;
        echo $this->signkey.$params; exit;
        $sign = hash('sha256', $this->signkey.$params);
        $data = array('merchant_code' => $this->merchant_code, 'params' => $params , 'sign' => $sign);

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($this->url, false, $context);
        //dd($result);
        return $result;
    }


    public function cp(Request $request)
    {
        $data = array();
        $data['method']='cm';
        $data['username']= 'phoenix12';
        $data['password']= '1q2w3e4r';
        $data['currency']= 'CNY';
        $data = json_encode($data);
        $this->send_require($data);
    }
}
