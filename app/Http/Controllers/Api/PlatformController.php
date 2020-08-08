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
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);

        $platform_name = "";
        if ($request->has('platform_name')) {
            $platform_name = $request->platform_name;
        }

        if ($request->start_time && $request->stop_time) {
            $game= array('AG','BBIN','OGPlus','AllBet','EG','WM','AVIA','IMSB','LC','VR','ThreeSing','SABA');

            if (in_array($platform_name,$game)) {
                $tableName = 'aq_'.strtolower($platform_name).'_record';
                $data = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereDate('BetDate', '>=',$request->start_time)->whereDate('BetDate', '<=',$request->stop_time)->get(
                    ['id', 'BetStatus', 'TotalWinlose', 'Bet', 'TotalPayout', 'BetDate']
                );

                $todayCount = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereBetween('BetDate', [$request->start_time, $request->stop_time])->selectRaw('DATE_FORMAT(BetDate,"%m-%d") as date,COUNT(id) as num ,SUM(Bet) as Bet,SUM(TotalPayout) as TotalPayout')
                    ->groupBy('date')->get();

                    $allCount = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereBetween('BetDate', [$request->start_time, $request->stop_time])->selectRaw('COUNT(id) as num ,SUM(Bet) as Bet,SUM(TotalPayout) as TotalPayout')
                        ->get();
            }

            if ($platform_name == 'ybqp') {
                $data = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereDate('st', '>=',$request->start_time)->whereDate('st', '<=',$request->stop_time)->get(
                    ['id', 'gn', 'mw', 'bc', 'tb', 'st']
                );

                $todayCount = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereBetween('st', [$request->start_time, $request->stop_time])->selectRaw('DATE_FORMAT(st,"%m-%d") as date,COUNT(id) as num ,SUM(tb) as tb,SUM(mp) as mp')
                    ->groupBy('date')->get();

                    $allCount = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereBetween('st', [$request->start_time, $request->stop_time])->selectRaw('COUNT(id) as num ,SUM(tb) as tb,SUM(mp) as mp')
                        ->get();
            }

/*             $data = Betting::orderBy('bottom_pour_time', 'desc')->where('username', $user->username)->whereDate('bottom_pour_time', '>=',$request->start_time)->whereDate('bottom_pour_time', '<=',$request->stop_time)->when($platform_name, function ($query) use ($platform_name) {
                $query->where('platform_name', '=', $platform_name);
            })->get(
                ['id', 'platform_name', 'game_name', 'bottom_pour', 'group_money', 'bottom_pour_time']
            );

            $todayCount = Betting::orderBy('bottom_pour_time', 'desc')->where('username', $user->username)->whereBetween('bottom_pour_time', [$request->start_time, $request->stop_time])->when($platform_name, function ($query) use ($platform_name) {
                $query->where('platform_name', '=', $platform_name);
            })->selectRaw('DATE_FORMAT(bottom_pour_time,"%m-%d") as date,COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
                ->groupBy('date')->get();

            $allCount = Betting::orderBy('bottom_pour_time', 'desc')->where('username', $user->username)->whereBetween('bottom_pour_time', [$request->start_time, $request->stop_time])->when($platform_name, function ($query) use ($platform_name) {
                $query->where('platform_name', '=', $platform_name);
            })->selectRaw('COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
                ->get(); */

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

            if ($data) {
                return response()->json(['msg' => '成功', 'data' => $data, 'code' => 200]);
            } else {
                return response()->json([
                    'code' => 0,
                    'msg' => "无数据",
                ], 200);
            }
        }

        $btime = date('Y-m-d H:i:s', time() - 7 * 24 * 60 * 60);
        $yesterday = "";
        if ($request->has('day')) {
            $btime = date('Y-m-d H:i:s', time() - $request->day * 24 * 60 * 60);
            if ($request->day == 2) {
                $yesterday = Carbon::yesterday();
            }
        }

        $game= array('AG','BBIN','OGPlus','AllBet','EG','WM','AVIA','IMSB','LC','VR','ThreeSing','SABA');

    if (in_array($platform_name,$game)) {
        $tableName = 'aq_'.strtolower($platform_name).'_record';
        $data = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereDate('BetDate', '>', $btime)->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('BetDate', '=', $yesterday);
        })->get(
            ['id', 'BetStatus', 'TotalWinlose', 'Bet', 'TotalPayout', 'BetDate']
        );

        $todayCount =DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereDate('BetDate', '>', $btime)->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('BetDate', '=', $yesterday);
        })->selectRaw('DATE_FORMAT(BetDate,"%m-%d") as date,COUNT(id) as num ,SUM(Bet) as Bet,SUM(TotalPayout) as TotalPayout')
            ->groupBy('date')->get();

        $allCount = DB::table($tableName)->orderBy('BetDate', 'desc')->where('MemberAccount', $user->username)->whereDate('BetDate', '>', $btime)->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('bottom_pour_time', '=', $yesterday);
        })->selectRaw('COUNT(id) as num ,SUM(Bet) as Bet,SUM(TotalPayout) as TotalPayout')
            ->get();

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

    if ($platform_name == 'ybqp') {
        $data = YbChessRecord::orderBy('st', 'desc')->where('mmi', $user->username)->whereDate('st', '>', $btime)->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('st', '=', $yesterday);
        })->get(
            ['id', 'gn', 'mw', 'bc', 'tb', 'st']
        );

        $todayCount = YbChessRecord::where('mmi', $user->username)->whereDate('st', '>', $btime)->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('st', '=', $yesterday);
        })->selectRaw('DATE_FORMAT(st,"%m-%d") as date,COUNT(id) as num ,SUM(tb) as tb,SUM(mp) as mp')
            ->groupBy('date')->get();

        $allCount = YbChessRecord::where('mmi', $user->username)->whereDate('st', '>', $btime)->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('bottom_pour_time', '=', $yesterday);
        })->selectRaw('COUNT(id) as num ,SUM(tb) as tb,SUM(mp) as mp')
            ->get();

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

 /*        $data = Betting::orderBy('bottom_pour_time', 'desc')->where('username', $user->username)->whereDate('bottom_pour_time', '>', $btime)->when($platform_name, function ($query) use ($platform_name) {
            $query->where('platform_name', '=', $platform_name);
        })->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('bottom_pour_time', '=', $yesterday);
        })->get(
            ['id', 'platform_name', 'game_name', 'bottom_pour', 'group_money', 'bottom_pour_time']
        );

        $todayCount = Betting::orderBy('bottom_pour_time', 'desc')->where('username', $user->username)->whereDate('bottom_pour_time', '>', $btime)->when($platform_name, function ($query) use ($platform_name) {
            $query->where('platform_name', '=', $platform_name);
        })->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('bottom_pour_time', '=', $yesterday);
        })->selectRaw('DATE_FORMAT(bottom_pour_time,"%m-%d") as date,COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
            ->groupBy('date')->get();

        $allCount = Betting::orderBy('bottom_pour_time', 'desc')->where('username', $user->username)->whereDate('bottom_pour_time', '>', $btime)->when($platform_name, function ($query) use ($platform_name) {
            $query->where('platform_name', '=', $platform_name);
        })->when($yesterday, function ($query) use ($yesterday) {
            $query->whereDate('bottom_pour_time', '=', $yesterday);
        })->selectRaw('COUNT(id) as num ,SUM(bottom_pour) as bottom_pour,SUM(group_money) as group_money')
            ->get();

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
        } */
    }
}
