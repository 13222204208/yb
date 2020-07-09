<?php

namespace App\Http\Controllers\Api;

use App\Model\Betting;
use App\Model\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function platformList()
    {
        $data = Platform::where('state',1)->get(['platform_name','id']);

        if ($data) {
            return response()->json( ['msg'=>'成功','data'=>$data,'code'=>200]);
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"无数据",
            ],200);
        }
    }

    public function platformRecord(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);

        if ($request->start_time && $request->stop_time) {

            $data = Betting::orderBy('bottom_pour_time','desc')->where('username',$user->username)->whereBetween('bottom_pour_time',[$request->start_time,$request->stop_time])->get(
                ['platform_name','game_name','bottom_pour','group_money','bottom_pour_time']
            );

            $todayCount = Betting::orderBy('bottom_pour_time','desc')->where('username',$user->username)->whereBetween('bottom_pour_time',[$request->start_time,$request->stop_time])->selectRaw('DATE_FORMAT(bottom_pour_time,"%m-%d") as date,COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
             ->groupBy('date')->get();

             $allCount = Betting::orderBy('bottom_pour_time','desc')->where('username',$user->username)->whereBetween('bottom_pour_time',[$request->start_time,$request->stop_time])->selectRaw('COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
             ->get();

            if ($data) {
                return response()->json( ['msg'=>'成功',
                                          'data'=>$data,
                                          'allCount'=>$allCount,
                                          'todayCount'=>$todayCount,
                                          'code'=>200]);
            }else {
                return response()->json([
                    'code' => 0,
                    'msg' =>"无数据",
                ],200);
            }

            if ($data) {
                return response()->json( ['msg'=>'成功','data'=>$data,'code'=>200]);
            }else {
                return response()->json([
                    'code' => 0,
                    'msg' =>"无数据",
                ],200);
            }
        }

        if ($request->day) {
            $btime =date('Y-m-d H:i:s',time()- $request->day*24*60*60);
        }else{
            $btime =date('Y-m-d H:i:s',time()- 7*24*60*60);
        }

        $data = Betting::orderBy('bottom_pour_time','desc')->where('username',$user->username)->whereDate('bottom_pour_time','>=',$btime)->get(
            ['platform_name','game_name','bottom_pour','group_money','bottom_pour_time']
        );

        $todayCount = Betting::orderBy('bottom_pour_time','desc')->where('username',$user->username)->whereDate('bottom_pour_time','>=',$btime)->selectRaw('DATE_FORMAT(bottom_pour_time,"%m-%d") as date,COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
         ->groupBy('date')->get();

         $allCount = Betting::orderBy('bottom_pour_time','desc')->where('username',$user->username)->whereDate('bottom_pour_time','>=',$btime)->selectRaw('COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
         ->get();

        if ($data) {
            return response()->json( ['msg'=>'成功',
                                      'data'=>$data,
                                      'allCount'=>$allCount,
                                      'todayCount'=>$todayCount,
                                      'code'=>200]);
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"无数据",
            ],200);
        }


    }
}
