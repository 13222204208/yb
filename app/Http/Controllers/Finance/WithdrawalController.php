<?php

namespace App\Http\Controllers\Finance;

use App\Model\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    public function queryWithdrawal(Request $request)
    {
        $limit= $request->get('limit'); 
        $data = Withdrawal::paginate($limit);
        return $data;
    }

    public function agreeWithdrawal(Request $request)
    {
        $withdrawal = Withdrawal::find($request->id);
        $withdrawal->state = 1;
        $status = $withdrawal->save();
        if ($status) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function resuseWithdrawal(Request $request)
    {
        $withdrawal = Withdrawal::find($request->id);
        $withdrawal->state = 0;
        $status = $withdrawal->save();
        if ($status) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function searchWithdrawal(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $order_num = $request->get('order_num');
        $state = $request->get('state');
        $startTime = $request->get('startTime');
        $stopTime = $request->get('stopTime');

        $withdrawal = new Withdrawal;
        $data= $withdrawal->when($order_num, function ($query) use ($order_num) {
            $query->where('order_num','=', $order_num);
        })->when($username, function ($query) use ($username) {
            $query->where('username', '=',$username);
        })->when(!is_null($state), function ($query) use ($state) {
            $query->where('state', $state);
        })->when($startTime, function ($query) use ($startTime,$stopTime) {
            $query->whereBetween('ask_time',[$startTime, $stopTime] ) ; 
        })->paginate($limit);
        return $data; 

    }
}
