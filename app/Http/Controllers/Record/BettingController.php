<?php

namespace App\Http\Controllers\Record;

use App\Model\Betting;
use App\Model\Platform;
use App\Model\YbChessRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BettingController extends Controller
{
    public function queryBetting(Request $request)
    {
        $limit = $request->get('limit');
        $data = Betting::paginate($limit);
        return $data;
    }

    public function queryPlatformName()
    {
        $data= Platform::groupBy('platform_name')->get();
        if ($data) {
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function searchBetting(Request $request)//搜索投注记录
    {
        $limit= $request->get('limit');
        $username = $request->get('username');
        $platform_name = $request->get('platform_name');
        $startTime = $request->get('startTime');
        $stopTime = $request->get('stopTime');

        $game = array('AG', 'BBIN', 'OGPlus', 'AllBet', 'EG', 'WM', 'AVIA', 'IMSB', 'LC', 'VR', 'ThreeSing', 'SABA');

        if (in_array($platform_name, $game)) {
            $tableName = 'aq_' . strtolower($platform_name) . '_record';
            $data = DB::table($tableName)->orderBy('BetDate', 'desc')->when($username, function ($query) use ($username) {
                $query->where('MemberAccount', '=',$username);
            })->whereDate('BetDate', '>=', $startTime)->whereDate('BetDate', '<=', $stopTime)->paginate($limit);

        }

        if ($platform_name == 'ybqp') { //亚博棋牌投注记录
            $data = YbChessRecord::orderBy('st', 'desc')->when($username, function ($query) use ($username) {
                $query->where('mmi', '=',$username);
            })->whereDate('st', '>=', $startTime)->whereDate('st', '<=', $stopTime)->paginate($limit);
        }

        if ($platform_name == 'bd' ) { //天成电子游戏投注记录
            $data = DB::table('tc_bd_record')->orderBy('betTime', 'desc')->when($username, function ($query) use ($username) {
                $query->where('username', '=',$username);
            })->whereDate('betTime', '>=', $startTime)->whereDate('betTime', '<=', $stopTime)->paginate($limit);

        }

        if ($platform_name == 'pvpbd') { //天成棋牌投注记录

            $data = DB::table('tc_pvpbd_record')->orderBy('betTime', 'desc')->when($username, function ($query) use ($username) {
                $query->where('username', '=',$username);
            })->whereDate('betTime', '>=', $startTime)->whereDate('betTime', '<=', $stopTime)->paginate($limit);

        }


        return $data;

/*         $betting = new Betting;
        $data= $betting->when($platform_name, function ($query) use ($platform_name) {
            $query->where('platform_name','=', $platform_name);
        })->when($username, function ($query) use ($username) {
            $query->where('username', '=',$username);
        })->when($startTime, function ($query) use ($startTime,$stopTime) {
            $query->whereBetween('bottom_pour_time',[$startTime, $stopTime] ) ;
        })->paginate($limit);
        return $data; */

    }
}
