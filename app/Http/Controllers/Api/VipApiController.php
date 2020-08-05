<?php

namespace App\Http\Controllers\Api;

use App\Model\UserDetail;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VipApiController extends Controller
{
    public function vipGrade(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);

        $amount= Transaction::where('username',$user->username)->where('business_state',1)->where('business_type','存款')->sum('business_money');

        $running= Transaction::where('username',$user->username)->where('business_state',1)->where('business_type','转账')->sum('business_money');

        $vip = 0;

        if ($amount >= 500 && $running >= 3000) $vip = 1;
        if ($amount >= 2000 && $running >= 12000) $vip = 2;
        if ($amount >= 10000 && $running >= 60000) $vip = 3;
        if ($amount >= 50000 && $running >= 300000) $vip = 4;
        if ($amount >= 200000 && $running >= 1200000) $vip = 5;
        if ($amount >= 500000 && $running >= 3000000) $vip = 6;
        if ($amount >= 1200000 && $running >= 7200000) $vip = 7;
        if ($amount >= 3000000 && $running >= 18000000) $vip = 8;
        if ($amount >= 10000000 && $running >= 60000000) $vip = 9;
        if ($amount >= 30000000 && $running >= 180000000) $vip = 10;

        UserDetail::where('username',$user->username)->update(['vip'=>$vip]);

        return response()->json([
            'msg' => '成功',
            'amount' => $amount,
            'running'=> $running,
            'vip' => $vip,
            'code' => 200
        ],200);
    }
}
