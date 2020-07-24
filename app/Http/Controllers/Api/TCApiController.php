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
       /*  $padded = $this->pkcs5_pad($plainText,8);
        $encText = openssl_encrypt($padded,'DES-ECB',$key); */
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
//$params ="qJ153L0WjoxYO2G2SQ2tA%2Bn5ZW75%2FFH6llz2WevLLfk4jA2Gpblts8BGnmMeY7Xks0tPaPA0iZFwkvX9EnVmofO0N97LLzadNNZ4ivyPDvA%3D";
        $sd = $params.$this->signKey;//echo $sd;exit;

        $sign = hash('sha256', $sd);//echo $sign;exit;
        //$params= urlencode(mb_convert_encoding($params, 'utf-8', 'gb2312'));echo $params;exit;
        //$sign ="d1778d4fe33f67caa4ec6fafad836b4bedfc8b24e4727b538c32b7f53572277c";
        $data = array('merchant_code' => $this->merchant_code, 'params' => $params , 'sign' => $sign);
        //dd($data);
        $this->curlData($this->url,$data);
/*         $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($this->url, false, $context); */
       // var_dump($result);
        //return $result;
    }


    public function cp(Request $request)
    {
        $data = array();
        $data['method']='cm';
        $data['username']= 'yangpanda1';
        $data['password']= 'yangpanda1';
        $data['currency']= 'CNY';
        //$data = json_encode($data);
        $result = $this->send_require($data);
        return $result;
    }
}
