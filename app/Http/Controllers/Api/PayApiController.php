<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayApiController extends Controller
{
    public $partner= "1007741772";
    public $key= "hvlnsfxwazmpxedyne";

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

    public function recharge(Request $request)
    {
        $data= array();
        $data['partner']=$this->partner;
        $data['service']='10101';
        $data['tradeNo']='dsafsad1324';
        $data['amount']='500';
        $data['notifyUrl']='https://www.zhihu.com/';
        $data['sign']= MD5('amount='.$data['amount'].'&notifyUrl='.$data['notifyUrl'].'&partner='.$data['partner'].'&service='.$data['service'].'&tradeNo='.$data['tradeNo'].'&'.$this->key);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url="https://newapi.9pay.vip/unionOrder";
        $this->curlData($url,http_build_query($data),$type);

    }
}
