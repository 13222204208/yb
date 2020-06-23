<?php

namespace App\Http\Controllers\Finance;

use App\Model\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RechargeController extends Controller
{
    public function queryRecharge(Request $request)
    {
        $limit= $request->get('limit'); 
       // $data= DB::table('f_recharge')->paginate($limit);
        $data = Recharge::paginate($limit);
        return $data;
    }

    public function agreeRecharge(Request $request)
    {
        $recharge = Recharge::find($request->id);
        $recharge->state = 1;
        $status = $recharge->save();
        if ($status) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function resuseRecharge(Request $request)
    {
        $recharge = Recharge::find($request->id);
        $recharge->state = 0;
        $status = $recharge->save();
        if ($status) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function searchRecharge(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $order_num = $request->get('order_num');
        $state = $request->get('state');
        $startTime = $request->get('startTime');
        $stopTime = $request->get('stopTime');

        $recharge = new Recharge;
        $data= $recharge->when($order_num, function ($query) use ($order_num) {
            $query->where('order_num','=', $order_num);
        })->when($username, function ($query) use ($username) {
            $query->where('username', '=',$username);
        })->when(!is_null($state), function ($query) use ($state) {
            $query->where('state', $state);
        })->when($startTime, function ($query) use ($startTime,$stopTime) {
            $query->whereBetween('remit_time',[$startTime, $stopTime] ) ; 
        })->paginate($limit);
        return $data; 

    }
}
