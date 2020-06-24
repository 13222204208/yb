<?php

namespace App\Http\Controllers\Record;

use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function queryTransaction(Request $request)
    {
        $limit= $request->get('limit');
        $data = Transaction::paginate($limit);
        return $data;
    }

    public function queryBusinessType()
    {
        $data= Transaction::groupBy('business_type')
                 ->pluck('business_type');
        if ($data) {
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function searchTransaction(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $order_num = $request->get('order_num');
        $business_type = $request->get('business_type');
        $startTime = $request->get('startTime');
        $stopTime = $request->get('stopTime');

        $transaction = new Transaction;
        $data= $transaction->when($order_num, function ($query) use ($order_num) {
            $query->where('order_num','=', $order_num);
        })->when($username, function ($query) use ($username) {
            $query->where('username', '=',$username);
        })->when($business_type, function ($query) use ($business_type) {
            $query->where('business_type', $business_type);
        })->when($startTime, function ($query) use ($startTime,$stopTime) {
            $query->whereBetween('ask_time',[$startTime, $stopTime] ) ; 
        })->paginate($limit);
        return $data; 

    }
}
