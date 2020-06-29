<?php

namespace App\Http\Controllers\Rebate;

use App\Model\Rebate;
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
}
