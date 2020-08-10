<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Model\Betting;
use App\Model\Platform;
use App\Model\YbChessRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PlatformController extends Controller
{
    public function platformList()
    {
        $data = Platform::where('state', 1)->get(['platform_name', 'id']);

        if ($data) {
            return response()->json(['msg' => '成功', 'data' => $data, 'code' => 200]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => "无数据",
            ], 200);
        }
    }

    public function platformRecord(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',

        ]);
        $user = JWTAuth::authenticate($request->token);


        $platform_name = $request->platform_name;

        if ($request->has('day')) {
            $day = $request->day;
            $request->start_time = date('Y-m-d Y-m-d H:i:s', time() - $day * 24 * 60 * 60);
            $request->stop_time =  date('Y-m-d Y-m-d H:i:s', time());

            if ($day == 1) {
                $request->start_time = date('Y-m-d', time());
                $request->stop_time =  date('Y-m-d H:i:s', time());
            }

            if ($day == 2) {
                $request->start_time = date('Y-m-d', time() -  24 * 60 * 60);
                $request->stop_time =  date('Y-m-d ', time());
            }
        }


        $game = array('AG', 'BBIN', 'OGPlus', 'AllBet', 'EG', 'WM', 'AVIA', 'IMSB', 'LC', 'VR', 'ThreeSing', 'SABA');

        if (in_array($platform_name, $game)) {
            $tableName = 'aq_' . strtolower($platform_name) . '_record';
            $data = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereDate('BetDate', '>=', $request->start_time)->whereDate('BetDate', '<=', $request->stop_time)->get(
                ['id', 'BetStatus', 'TotalWinlose', 'Bet', 'TotalPayout', 'BetDate']
            );

            $todayCount = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereBetween('BetDate', [$request->start_time, $request->stop_time])->selectRaw('DATE_FORMAT(BetDate,"%m-%d") as date,COUNT(id) as num ,SUM(Bet) as Bet,SUM(TotalWinlose) as TotalWinlose')
                ->groupBy('date')->get();

            $allCount = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereBetween('BetDate', [$request->start_time, $request->stop_time])->selectRaw('COUNT(id) as num ,SUM(Bet) as Bet,SUM(TotalWinlose) as TotalWinlose')
                ->get();
        }

        if ($platform_name == 'ybqp') { //亚博棋牌投注记录
            $data = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereDate('st', '>=', $request->start_time)->whereDate('st', '<=', $request->stop_time)->get(
                ['id', 'gn', 'mw', 'bc', 'tb', 'st']
            );

            $todayCount = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereBetween('st', [$request->start_time, $request->stop_time])->selectRaw('DATE_FORMAT(st,"%m-%d") as date,COUNT(id) as num ,SUM(tb) as tb,SUM(mw) as mw')
                ->groupBy('date')->get();

            $allCount = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereBetween('st', [$request->start_time, $request->stop_time])->selectRaw('COUNT(id) as num ,SUM(tb) as tb,SUM(mw) as mw')
                ->get();
        }

        if ($platform_name == 'bd' && $request->has('productType')) { //天成电子游戏投注记录
            $productType = $request->productType;
            $data = DB::table('tc_bd_record')->orderBy('betTime', 'desc')->where('username', $user->username)->where('productType', $productType)->whereDate('betTime', '>=', $request->start_time)->whereDate('betTime', '<=', $request->stop_time)->get(
                ['id', 'betAmount', 'winAmount', 'netPnl', 'betTime']
            );

            $todayCount = DB::table('tc_bd_record')->orderBy('betTime', 'desc')->where('username', $user->username)->where('productType', $productType)->whereBetween('betTime', [$request->start_time, $request->stop_time])->selectRaw('DATE_FORMAT(betTime
                ,"%m-%d") as date,COUNT(id) as num ,SUM(betAmount
                ) as betAmount
                ,SUM(netPnl) as netPnl')
                ->groupBy('date')->get();

            $allCount = DB::table('tc_bd_record')->orderBy('betTime', 'desc')->where('username', $user->username)->where('productType', $productType)->whereBetween('betTime', [$request->start_time, $request->stop_time])->selectRaw('COUNT(id) as num ,SUM(betAmount
                    ) as betAmount
                    ,SUM(netPnl) as netPnl')
                ->get();
        }

        if ($platform_name == 'pvpbd') { //天成棋牌投注记录

            $data = DB::table('tc_pvpbd_record')->orderBy('betTime', 'desc')->where('username', $user->username)->whereDate('betTime', '>=', $request->start_time)->whereDate('betTime', '<=', $request->stop_time)->get(
                ['id', 'betAmount', 'rake', 'netPnl', 'betTime']
            );

            $todayCount = DB::table('tc_pvpbd_record')->orderBy('betTime', 'desc')->where('username', $user->username)->whereBetween('betTime', [$request->start_time, $request->stop_time])->selectRaw('DATE_FORMAT(betTime
                ,"%m-%d") as date,COUNT(id) as num ,SUM(betAmount
                ) as betAmount
                ,SUM(netPnl) as netPnl')
                ->groupBy('date')->get();

            $allCount = DB::table('tc_pvpbd_record')->orderBy('betTime', 'desc')->where('username', $user->username)->whereBetween('betTime', [$request->start_time, $request->stop_time])->selectRaw('COUNT(id) as num ,SUM(betAmount
                    ) as betAmount
                    ,SUM(netPnl) as netPnl')
                ->get();
        }


        if ($data) {
            return response()->json([
                'msg' => '成功',
                'data' => $data,
                'allCount' => $allCount,
                'todayCount' => $todayCount,
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
