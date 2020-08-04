<?php

namespace App\Http\Controllers\Api;

use App\Model\UserDetail;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class FastApiController extends Controller
{

    public function curlData($url,$data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_URL, $url);//要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1);// 发送一个常规的POST请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);//执行并获取数据

        curl_close($ch);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['GameCode'] = $request->GameCode;
        $data['UserIP'] =  $request->UserIP;
        $data['DeviceType']= intval($request->DeviceType);
        $data['IsTrial'] = intval($request->IsTrial);
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function balance(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $this->curlData($url,$data);

    }

    public function transfer(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['TransType'] = $request->TransType;
        $data['Amount'] = $request->Amount;
        $data['OrderNo'] = $request->OrderNo;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        //转帐
        $money= UserDetail::where('username',$user->username)->first();
        if ($request->TransType == 'Deposit') {
            if ($money->balance < $request->Amount) {
                return response()->json([
                    'code' => 1001,
                    'msg' => '金额不足',
                ], 200);
            }else {
                $money->balance = $money->balance - $request->Amount;
            }
        }

        if ($request->TransType == 'Withdraw') {
            $money->balance = $money->balance + $request->Amount;
        }

        $result= $this->curlData($url,$data);

        Log::info('statusStr.', ['s'=>$result]);
        if ($result === true) {
            $money->save();

            $transaction= new Transaction;
            $transaction->order_num= $request->OrderNo;
            $transaction->username= $user->username;
            $transaction->business_type= '转帐';
            $transaction->business_mode= $request->TransType;
            $transaction->business_money= $request->Amount;
            $transaction->ask_time= date('Y-m-d H:i:s');
            $transaction->save();
        }

    }

    public function checkTransfer(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['OrderNo'] = $request->OrderNo;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $url = $request->url;

        $res= $this->curlData($url,$data);
        Log::info('statusStr.', ['res'=>$res]);
        return response()->json(['res'=>$res]);
    }
}
