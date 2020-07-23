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

    function encryptText($str, $key)
    {
        $str = $this->pkcsPadding($str, 8);
        $data = openssl_encrypt($str, 'DES-ECB', $key);    // 加密
        return base64_encode($data);
    }

    private function pkcsPadding($str, $blocksize)
    {
        $pad = $blocksize - (strlen($str) % $blocksize);
        return $str . str_repeat(chr($pad), $pad);
    }



    public function send_require($sendParams){
        $params =  $this->encryptText($sendParams,$this->desKey);//echo $this->signkey; exit;
        //echo $params; exit;
        $sign = hash('sha256',$params. $this->signkey);//echo $sign;exit;
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
