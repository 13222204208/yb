<?php

namespace App\Http\Controllers\Api;

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
        return response()->json([
            'msg' => '成功',
            'amount' => $amount,
            'running'=> $running,
            'code' => 200
        ]);
    }
}
