<?php

namespace App\Http\Controllers\Api;

use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function transactionRecord(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);

        $business_type = "";
        if ($request->has('business_type')) {
            $business_type = $request->business_type;
        }

        if ($request->start_time && $request->stop_time) {

            $data = Transaction::orderBy('ask_time', 'desc')->where('username', $user->username)->whereDate('ask_time', '>=',$request->start_time)->whereDate('ask_time', '<=',$request->stop_time)->when($business_type, function ($query) use ($business_type) {
                $query->where('business_type', '=', $business_type);
            })->get(
                ['id', 'business_type', 'business_mode', 'business_money', 'business_state', 'ask_time','order_num']
            );

/*             $todayCount = Transaction::orderBy('ask_time', 'desc')->where('username', $user->username)->whereBetween('ask_time', [$request->start_time, $request->stop_time])->when($business_type, function ($query) use ($business_type) {
                $query->where('business_type', '=', $business_type);
            })->selectRaw('DATE_FORMAT(ask_time,"%m-%d") as date,COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
                ->groupBy('date')->get();

            $allCount = Transaction::orderBy('ask_time', 'desc')->where('username', $user->username)->whereBetween('ask_time', [$request->start_time, $request->stop_time])->when($business_type, function ($query) use ($business_type) {
                $query->where('business_type', '=', $business_type);
            })->selectRaw('COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
                ->get(); */

            if ($data) {
                return response()->json([
                    'msg' => '成功',
                    'data' => $data,
                    'code' => 200
                ]);
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => "无数据",
                ], 200);
            }

            if ($data) {
                return response()->json(['msg' => '成功', 'data' => $data, 'code' => 200]);
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => "无数据",
                ], 200);
            }
        }

        $btime = date('Y-m-d H:i:s', time()- 1* 24 * 60 * 60);
        $yesterday = "";
        if ($request->has('day')) {
            $btime = date('Y-m-d H:i:s', time() - $request->day * 24 * 60 * 60);
            if ($request->day == 2) {
                $yesterday = Carbon::yesterday();
            }
        }

        $data = Transaction::orderBy('ask_time', 'desc')->where('username', $user->username)->whereDate('ask_time', '>=', $btime)->when($business_type, function ($query) use ($business_type) {
            $query->where('business_type', '=', $business_type);
        })->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('ask_time', '=', $yesterday);
        })->get(
            ['id', 'business_type', 'business_mode', 'business_money', 'business_state', 'ask_time','order_num']
        );

   /*      $todayCount = Transaction::orderBy('ask_time', 'desc')->where('username', $user->username)->whereDate('ask_time', '>', $btime)->when($business_type, function ($query) use ($business_type) {
            $query->where('business_type', '=', $business_type);
        })->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('ask_time', '=', $yesterday);
        })->selectRaw('DATE_FORMAT(ask_time,"%m-%d") as date,COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
            ->groupBy('date')->get();

        $allCount = Transaction::orderBy('ask_time', 'desc')->where('username', $user->username)->whereDate('ask_time', '>', $btime)->when($business_type, function ($query) use ($business_type) {
            $query->where('business_type', '=', $business_type);
        })->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('ask_time', '=', $yesterday);
        })->selectRaw('COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
            ->get(); */

        if ($data) {
            return response()->json([
                'msg' => '成功',
                'data' => $data,
                'code' => 200
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => "无数据",
            ], 200);
        }
    }
}
