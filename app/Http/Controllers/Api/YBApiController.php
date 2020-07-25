<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YBApiController extends Controller
{
    public function __construct(){
        $this->agent = 'by20072101';	//商户编号
        $this->timestamp = time();		//时间戳
        $this->secret_key = "C6ypm6dhenoHFBBU";//商户密钥
        $this->iv = "0102030405060708 ";//IV向量
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

    public function launchGame(Request $request)
    {
        echo $this->sign;
    }
}
