<?php

namespace App\Http\Controllers\Rebate;

use App\Model\Rebate;
use App\Model\VipRebate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RebateRateController extends Controller
{

    public function createRebate(Request $request)
    {
        if ($request->ajax()) {
            $rebate = new Rebate;
            $rebate->rebate_grade = $request->rebate_grade;
            $rebate->game_type = $request->game_type;
            $rebate->rebate_name = $request->rebate_name;
            $rebate->money = intval($request->money);
            $rebate->rebate_scale = intval($request->rebate_scale);
            $status = $rebate->save();

            if($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }

    public function queryRebate(Request $request)
    {
        $limit = $request->get('limit');
        $data = Rebate::paginate($limit);
        return $data;
    }

    public function createVipRebate(Request $request)
    {
        if ($request->ajax()) {
            $rebate = new VipRebate;
            $rebate->vip = intval($request->vip);
            $rebate->day_num = intval($request->day_num);
            $rebate->balance = intval($request->balance);
            $rebate->cash_gift = intval($request->cash_gift);
            $rebate->red_packet = intval($request->red_packet);
            $rebate->min_transfer = intval($request->min_transfer);
            $rebate->bonus = intval($request->bonus);
            $rebate->max_bonus = intval($request->max_bonus);
            $rebate->water_multiples = intval($request->water_multiples);
            $rebate->num_restrict = intval($request->num_restrict);
            $rebate->appoint = $request->appoint;
            $status = $rebate->save();

            if($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }

    public function queryVipRebate(Request $request)
    {
        $limit = $request->get('limit');
        $data = VipRebate::paginate($limit);
        return $data;
    }
}
