<?php

namespace App\Http\Controllers\Api;

use App\Model\BetGame;
use App\Model\UserInfo;
use App\Model\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CheckAccountController extends Controller
{
    public function utime()
    {
        date_default_timezone_set('America/New_York');

        $datetime= date("c", time());
        return $datetime;
    }

    public function checkAccount(Request $request,$allCount)
    {
     /*    $this->validate($request, [
            'account' => 'required|max:36'
        ]); */

 /*        function setToken($phone){
            $str = md5(uniqid(md5(microtime(true)),true));
            $token = sha1($str.$phone);
            return $token;
      }
        $token= setToken('573516293'); */
        $wtoken=$request->header('wtoken');
        //Log::debug('An informational message.'.$wtoken);
        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $status = ['code'=>'0','message'=>'Success','datetime'=>$this->utime()];
        if (UserInfo::where('username','=',$allCount)->exists()) {
            return response()->json([
                'data' => true,
                'status' =>$status,
            ], 200);
        }else{
            return response()->json([
                'data' => false,
                'status' =>$status,
            ], 200);
        }
    }

    public function gameBet(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }
      //  Log::debug('An informational message.'.$request->all());
/*         $bet = new BetGame;
        $bet->username = $request->account;
        $bet->eventTime = $request->eventTime;
        $bet->gamehall = $request->gamehall;
        $bet->gamecode = $request->gamecode;
        $bet->roundid = $request->roundid;
        $bet->amount = $request->amount;
        $bet->mtcode = $request->mtcode;
        if ($request->has('session')) {
            $bet->session = $request->session;
        }
        $bet->save(); */

        $data= ['balance'=>5000.50,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>$this->utime()];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameEndround(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameRollout(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameTakeall(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameRollin(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameDebit(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameCredit(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameBonus(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function userPayoff(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameRefund(Request $request)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= ['balance'=>600210,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameRecord(Request $request,$mtcode)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= array( "_id"=> "59672a547aa48000019260cf",
        "action"=> "bet",
        "target"=>array("account"=>"fifi"),
        "status"=>array(
            "createtime"=>"2017-07-13T04:07:48.644-04:00",
            "endtime"=> "2017-07-13T04:07:48.673-04:00",
            "status"=>"success",
            "message"=> "success"
        ),
        "before"=> 8164082.95,
        "balance"=>8164072.95,
        "currency"=>"CNY",
        "event" =>array(
            "mtcode"=> "testbet1123456:GC",
              "amount"=>10,
              "eventtime"=> "2017-07-05T05:08:41-04:00"
        ),
    );
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>"2017-01-19T22:56:30.0151001-05:00"];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }

    public function gameBalance(Request $request,$account)
    {
        $wtoken=$request->header('wtoken');

        if ($wtoken !== config('wtoken.token') ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }

        $data= UserDetail::where('username',$request->account)->get('balance','currency');

        //$data= ['balance'=>123456.50,'currency'=>"CNY"];
        $status = ['code'=>"0",'message'=>"Success",'datetime'=>$this->utime()];
        return response()->json([
            'data' => $data,
            'status' => $status
        ], 200);
    }
}
