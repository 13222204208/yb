<?php

namespace App\Http\Controllers\Api;

use App\Model\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CheckAccountController extends Controller
{
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
        Log::debug('An informational message.'.$wtoken);
        if ($wtoken !== "704ec5402224343d247289ca83fe4b1fd5507198" ) {
            return response()->json([
                'data' => false,
                'msg' => "token错误",
            ], 200);
        }
        date_default_timezone_set('America/New_York');

        $datetime= date("c", time());
        $status = ['code'=>'0','message'=>'Success','datetime'=>$datetime];
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
}
