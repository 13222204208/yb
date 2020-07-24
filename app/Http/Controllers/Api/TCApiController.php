<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TCApiController extends Controller
{
    public function __construct(){
        $this->url = 'http://www.connect6play.com/doBusiness.do';					//API 连接
        $this->merchant_code = 'byylcny';		//代理商号
        $this->desKey = 'ZADKwrWZ';				//加密金钥
        $this->signKey = 'tw3947BNYH3Y1pn9';				//加密签名档
        $this->currency = 'CNY'; 						//币别
    }
    /**
     * 组建en json参数数组
     * @param $plainText
     * @param $key
     * @return string
     */
    public function encryptText($plainText, $key) {;
        $padded = $this->pkcs5_pad($plainText,mcrypt_get_block_size("des", "ecb"));
        $encText = mcrypt_encrypt("des",$key, $padded, "ecb");
        return base64_encode($encText);
    }


    public function pkcs5_pad ($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }


    public function send_require($sendParams){
        $params =  $this->encryptText(json_encode($sendParams),$this->desKey);echo $this->desKey;exit;
        $sign = hash('sha256', $params . $this->signKey);
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
        var_dump($result);
        return $result;
    }


    public function cp(Request $request)
    {
        $data = array();
        $data['method']='cm';
        $data['username']= 'yangpanda';
        $data['password']= 'yangpanda';
        $data['currency']= 'CNY';
        //$data = json_encode($data);
        $this->send_require($data);
    }
}
