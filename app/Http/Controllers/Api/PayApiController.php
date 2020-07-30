<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

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
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::authenticate($request->token);

        $data= array();
        $data['partner']= $this->partner;
        $data['service']= $request->service;
        $data['tradeNo']= $request->tradeNo;
        $data['amount']= $request->amount;
        $data['notifyUrl']= $request->notifyUrl;
        $data['resultType']= $request->resultType;
        $data['sign']= MD5('amount='.$data['amount'].'&notifyUrl='.$data['notifyUrl'].'&partner='.$data['partner'].'&resultType='.$data['resultType'].'&service='.$data['service'].'&tradeNo='.$data['tradeNo'].'&'.$this->key);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url= $request->url;
        $this->curlData($url,http_build_query($data),$type);

    }

    public function agentPay(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::authenticate($request->token);

        $data= array();
        $data['partner']= $this->partner;
        $data['service']= $request->service;
        $data['tradeNo']= $request->tradeNo;
        $data['bankCode']= $request->bankCode;
        $data['bankCardNo']= $request->bankCardNo;
        $data['bankCardholder']= $request->bankCardholder;
        $data['subsidiaryBank']= $request->subsidiaryBank;
        $data['subbranch']= $request->subbranch;
        $data['province']= $request->province;
        $data['city']= $request->city;
        $data['amount']= $request->amount;
        $data['notifyUrl']= $request->notifyUrl;
        $data['extra']= $request->extra?$request->extra:'noting';
        $data['sign']= MD5('amount='.$data['amount'].'&bankCardNo='.$data['bankCardNo'].'&bankCardholder='.$data['bankCardholder'].
        '&bankCode='.$data['bankCode'].'&city='.$data['city'].'&extra='.$data['extra'].'&notifyUrl='.$data['notifyUrl'].'&partner='.$data['partner'].'&province='.$data['province'].'&service='.$data['service'].'&subbranch='.$data['subbranch'].
        '&subsidiaryBank='.$data['subsidiaryBank'].'&tradeNo='.$data['tradeNo'].'&'.$this->key);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url= $request->url;
        $this->curlData($url,http_build_query($data),$type);

    }

    public function orderQuery(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::authenticate($request->token);

        $data= array();
        $data['partner']= $this->partner;
        $data['service']= $request->service;
        $data['outTradeNo'] = $request->outTradeNo;
        $data['sign']= MD5('outTradeNo='.$data['outTradeNo'].'&partner='.$data['partner'].'&service='.$data['service'].'&'.$this->key);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url= $request->url;
        $this->curlData($url,http_build_query($data),$type);

    }

    public function balanceQuery(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::authenticate($request->token);

        $data= array();
        $data['partner']= $this->partner;
        $data['service']= $request->service;
        $data['sign']= MD5('partner='.$data['partner'].'&service='.$data['service'].'&'.$this->key);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url= $request->url;
        $this->curlData($url,http_build_query($data),$type);

    }

    public function notifyUrl(Request $request)
    {
        $num = 1;
        if ($request->statusStr) {
            $request->statusStr="存在";
        }else {
            $request->statusStr="不存在";
        }
        Log::info('statusStr.', ['str'=>$request->statusStr,'num'=>$num]);
        return 'success';
    }
}
