<?php

namespace App\Http\Controllers\Api;

use App\Model\UserDetail;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class TCApiController extends Controller
{
    public function __construct()
    {
        $this->url = 'http://www.connect6play.com/doBusiness.do';                    //API 连接
        $this->merchant_code = 'byylcny';        //代理商号
        $this->desKey = 'ZADKwrWZ';                //加密金钥
        $this->signKey = 'tw3947BNYH3Y1pn9';                //加密签名档
        $this->currency = 'CNY';                         //币别
    }

    public function curlData($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-type: application/x-www-form-urlencoded;charset=UTF-8"
        ));
        curl_setopt($ch, CURLOPT_URL, $url); //要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1); // 发送一个常规的POST请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $res = curl_exec($ch); //执行并获取数据
        curl_close($ch);
        return $res;
    }

    /**
     * 组建en json参数数组
     * @param $plainText
     * @param $key
     * @return string
     */
    public function encryptText($plainText, $key)
    {;

        $encText = openssl_encrypt($plainText, 'DES-ECB', $key, OPENSSL_RAW_DATA);
        return base64_encode($encText);
    }


    public function send_require($sendParams)
    {
        $params =  $this->encryptText(json_encode($sendParams), $this->desKey);

        $sd = $params . $this->signKey; //echo $sd;exit;

        $sign = hash('sha256', $sd); //echo $sign;exit;

        $data = array('merchant_code' => $this->merchant_code, 'params' => $params, 'sign' => $sign);

        $res = $this->curlData($this->url, $data);
        return $res;
    }


    public function CRegister(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method'] = "cm";
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $data['currency'] = $this->currency;

        $result = $this->send_require($data);
        return $result;
    }

    public function gameList(Request $request)
    {
        $data = array();
        $data['method'] = "tgl";
        $data['language'] = "ZH_CN";
        $data['product_type'] = $request->product_type;
        $data['platform'] = $request->platform;
        $data['client_type'] = $request->client_type;
        $data['game_type'] = $request->game_type;
        if ($request->page) {
            $data['page'] = $request->page;
        }
        if ($request->page_size) {
            $data['page_size'] = $request->page_size;
        }

        $result = $this->send_require($data);
        return $result;
    }

    public function launchGame(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method'] = "lg";
        $data['username'] = $request->username;
        $data['product_type'] = $request->product_type;
        if ($request->platform) {
            $data['platform'] = $request->platform;
        }
        $data['game_mode'] = $request->game_mode;
        $data['game_code'] = $request->game_code;

        if ($request->view) {
            $data['view'] = $request->view;
        }

        if ($request->back_url) {
            $data['back_url'] = $request->back_url;
        }

        if ($request->lottery_bet_mode) {
            $data['lottery_bet_mode'] = $request->lottery_bet_mode;
        }

        if ($request->language) {
            $data['language'] = $request->language;
        }

        if ($request->series) {
            $data['series'] = $request->series;
        }
        //return response()->json($data);
        $result = $this->send_require($data);
        return $result;
    }

    public function balance(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method'] = "gb";
        $data['username'] = $request->username;
        $data['product_type'] = $request->product_type;

        $result = $this->send_require($data);
        return $result;
    }

    public function transfer(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method'] = "ft";
        $data['username'] = $request->username;
        $data['product_type'] = $request->product_type;
        $data['fund_type'] = $request->fund_type;
        $data['amount'] = $request->amount;
        $data['reference_no'] = $request->reference_no;

        //转帐
        $money = UserDetail::where('username', $user->username)->first();
        if ($request->fund_type == 1) {
            if ($money->balance < $request->amount) {
                return response()->json([
                    'code' => 1001,
                    'msg' => '金额不足',
                ], 200);
            } else {
                $money->balance = $money->balance - $request->amount;
            }
        }

        if ($request->TransType == 2) {
            $money->balance = $money->balance + $request->amount;
        }


        $result = $this->send_require($data);
        $state = json_decode($result, true);
        //Log::info('arr.', ['tc'=>$state]);
        if ($state['status'] === 0) {
            $money->save();

            $transaction = new Transaction;
            $transaction->order_num = $request->reference_no;
            $transaction->username = $user->username;
            $transaction->business_type = '转账';
            $transaction->business_mode = $request->fund_type;
            $transaction->business_money = $request->amount;
            if ($request->business_game) {
                $transaction->business_game = $request->business_game;
            }
            $transaction->ask_time = date('Y-m-d H:i:s');
            $transaction->business_state = 1;
            $transaction->save();
        }

        return $result;
    }

    public function checkTransaction(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        if ($user->username != $request->username) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }

        $data = array();
        $data['method'] = "cs";
        $data['product_type'] = $request->product_type;
        $data['ref_no'] = $request->ref_no;

        $result = $this->send_require($data);
        return $result;
    }

    public function gameRecord(Request $request)
    {
        $game= array('pvpbd','bd');


        $time= date('YmdHi',time()-15*60);

        $num= intval(substr($time,10));
        if ($num >= 0 && $num < 15) $batch_name = substr($time,0,-2).'00';
        if ($num >= 15 && $num < 30) $batch_name = substr($time,0,-2).'15';
        if ($num >= 30 && $num < 45) $batch_name = substr($time,0,-2).'30';
        if ($num >= 45 && $num < 60) $batch_name = substr($time,0,-2).'45';
        $data = array();
        for ($i = 0; $i < count($game); $i++) {

            $data['method'] = $game[$i];
            $data['batch_name'] = $batch_name;
            $result = $this->send_require($data);

            $record = json_decode($result, true);
            if ($record['details'] != null) {
                $len = count($record['details']);
                if ($data['method'] == 'pvpbd') {
                    for ($i=0; $i < $len; $i++) {
                        $record['details'][$i]['additionalInfo']= json_encode($record['details'][$i]['additionalInfo']);
                    }
                }

                if ($record['details'] != null && $record['status'] === 0) {
                    $tableName = 'tc_'.$data['method'].'_record';//拼接数据表名,插入数据
                    DB::table($tableName)->insert($record['details']);
                }
            }

        }
    }

    public function lotteryRecord()
    {
        $source = "/source.txt";
        $target = "/ELOTTO/SETTLED/20200811/202008111450_0001.json";

$url= 'ftp://123.51.167.66/TLOTTO/CANCELLED/20200811/202008111450_0001.json';

        $host = '123.51.167.66';
        $user = 'byylcny';
        $pwd = 'a123456';

        $f_conn = ftp_connect($host);

        if(!$f_conn){
            echo "connect fail\n";
            exit(1);
        }
        echo "connect success\n";

        // 进行ftp登录，使用给定的ftp登录用户名和密码进行login
        $f_login = ftp_login($f_conn,$user,$pwd);
        if(!$f_login){
            echo "login fail\n";
            exit(1);
        }
        echo "login success\n";

        $content = ftp_nlist($f_conn, "/ELOTTO/SETTLED/20200811/");
        dd($content);
        ftp_nb_get($f_conn,$target,$source,FTP_ASCII);
        // 获取当前所在的ftp目录
        $in_dir = ftp_pwd($f_conn);
        if(!$in_dir){
            echo "get dir info fail\n";
            exit(1);
        }
        echo "$in_dir\n";

/*         // 获取当前所在ftp目录下包含的目录与文件
        $exist_dir = ftp_nlist($f_conn, ftp_pwd($f_conn));
        print_r($exist_dir);

        // 要求是按照日期在ftp目录下创建文件夹作为文件上传存放目录
        echo date("Ymd")."\n";
        $dir_name = date("Ymd");
        // 检查ftp目录下是否已存在当前日期的文件夹，如不存在则进行创建
        if(!in_array("$in_dir/$dir_name", $exist_dir)){
            if(!ftp_mkdir($f_conn, $dir_name)){
                echo "mkdir fail\n";
                exit(1);
            }else{
                echo "mkdir $dir_name success\n";
            }
        }
        // 切换目录
        if(!ftp_chdir($f_conn, $dir_name)){
            echo "chdir fail\n";
            exit(1);
        }else{
            echo "chdir $dir_name success\n";
        }
        // 进行文件上传
        $result = ftp_put($f_conn, 'bbb.mp3', '/root/liang/ftp/bbb.mp3', FTP_BINARY);
        if(!$result){
            echo "upload file fail\n";
            exit(1);
        }else{
            echo "upload file success\n";
            exit(0);
        } */
    }
}
