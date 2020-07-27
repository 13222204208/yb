<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YBCPApiController extends Controller
{
    public $merchant= "byyl";
    public $signKey= "94D5BD8FCF4940CD";
    public function curlData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:application/json",
            "User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)"
        ));
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);//执行并获取数据
        curl_close($ch);
    }

    public function memberCreate(Request $request)
    {
        $data= array();
        $data['member']="aabadfa1";
        $data['memberType'] = 3;
        $data['password'] = "asdfdsfsdfavad12";
        $data['merchant'] = $this->merchant;
        $data['doubleList'] = "";
        $data['normalList'] = "";
        $data['timestamp'] = time();
        $data['sign']=md5('member'.$data['member'].'memberType'.$data['memberType'].'password'.$data['password'].
                          'merchant'.$data['merchant'].'doubleList'.$data['doubleList'].'normalList'.$data['normalList'].
                        'timestamp'.$data['timestamp'].$this->signKey);
        $url="http://api.shayexiang.com/boracay/api/member/create";
        $this->curlData($url,http_build_query($data));
    }
}
