<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class YBCPApiController extends Controller
{
    public $merchant= "byyl";
    public $signKey= "94D5BD8FCF4940CD";
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

    public function memberCreate(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();
        $data['member']= $request->member;
        $data['memberType'] = $request->memberType;
        $data['password'] = $request->password;
        $data['merchant'] = $this->merchant;
        $data['doubleList'] = "";
        $data['normalList'] = "";
        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('doubleList'.'member'.$data['member'].'memberType'.$data['memberType'].
        'merchant'.$data['merchant'].'normalList'.$data['normalList'].'password'.$data['password'].
                        'timestamp'.$data['timestamp'].$this->signKey);

        $type= array("Content-Type:application/json","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        //return http_build_query($data);
        $this->curlData($url,json_encode($data),$type);
    }

    public function memberLogin(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();
        $data['member']= $request->member;
        $data['password'] = $request->password;
        $data['merchant'] = $this->merchant;
        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('member'.$data['member'].
        'merchant'.$data['merchant'].'password'.$data['password'].
                        'timestamp'.$data['timestamp'].$this->signKey);

        $type= array("Content-Type:application/x-www-form-urlencoded","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        $this->curlData($url,http_build_query($data),$type);
    }

    public function transferBalance(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();
        $data['amount']= $request->amount;
        $data['member']= $request->member;
        $data['transferType'] = intval($request->transferType);
        $data['merchantAccount'] = $this->merchant;
        $data['notifyId']= $request->notifyId;
        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('amount'.$data['amount'].'member'.$data['member'].'merchantAccount'.$data['merchantAccount'].'notifyId'.$data['notifyId'].'timestamp'.$data['timestamp'].'transferType'.$data['transferType'].$this->signKey);

        $type= array("Content-Type:application/json","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        //return http_build_query($data);
        $this->curlData($url,json_encode($data),$type);
    }

    public function balanceQuery(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();

        $data['member']= $request->member;

        $data['merchant'] = $this->merchant;

        $data['timestamp'] = (int)(microtime(true)*1000);
        $data['sign']=md5('member'.$data['member'].'merchant'.$data['merchant'].
                        'timestamp'.$data['timestamp'].$this->signKey);

        $type= array("Content-Type:application/json","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        $this->curlData($url,json_encode($data),$type);
    }

    public function balanceRecords(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->member) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data= array();

        $data['endTime']= $request->endTime?$request->endTime:'';
        $data['member']= $request->member;
        $data['merchant'] = $this->merchant;
        $data['notifyId']= $request->notifyId?$request->notifyId:'';
        $data['pageSize']= $request->pageSize?$request->pageSize:'';
        $data['pageNum']= $request->pageNum?$request->pageNum:'';
        $data['startTime']= $request->startTime?$request->startTime:'';
        $data['timestamp'] =(int)(microtime(true)*1000);
        $data['tradeType'] = $request->tradeType?$request->tradeType:'';
        $data['sign']=md5('endTime'.$data['endTime'].'member'.$data['member'].'merchant'.$data['merchant'].'notifyId'.$data['notifyId'].'pageNum'.$data['pageNum'].'pageSize'.$data['pageSize'].'startTime'.$data['startTime'].'timestamp'.$data['timestamp'].'tradeType'.$data['tradeType'].$this->signKey);

        $type= array("Content-Type:application/json","User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64)");

        $url=$request->url;
        $this->curlData($url,json_encode($data),$type);
    }

    public function ybcpRecord()
    {

        $date = date('ym/d',time()-8*60*60);
        $url ='http://pull.shayexiang.com/'.$date.'/real/order/';
        return $url;
        $header = array(
            'Accept: application/json',
         );
         $curl = curl_init();
         //设置抓取的url
         curl_setopt($curl, CURLOPT_URL, $url);
         //设置头文件的信息作为数据流输出
         curl_setopt($curl, CURLOPT_HEADER, 0);
         // 超时设置,以秒为单位
         curl_setopt($curl, CURLOPT_TIMEOUT, 10);

         // 超时设置，以毫秒为单位
         // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

         // 设置请求头
         curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
         //设置获取的信息以文件流的形式返回，而不是直接输出。
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
         //执行命令
         $data = curl_exec($curl);

         // 显示错误信息
         if (curl_error($curl)) {
             print "Error: " . curl_error($curl);
         } else {
             // 打印返回的内容
             var_dump($data);
             curl_close($curl);
         }
    }
}
