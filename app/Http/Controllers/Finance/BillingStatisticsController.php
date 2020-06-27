<?php

namespace App\Http\Controllers\Finance;

use App\Model\ManualBills;
use Illuminate\Http\Request;
use App\Model\UserStatistics;
use App\Http\Controllers\Controller;

class BillingStatisticsController extends Controller
{
    public function queryManualBills(Request $request)
    {
        $limit = $request->get('limit');
        $data = ManualBills::paginate($limit);
        return $data;
    }

    public function queryBillStatistics(Request $request)
    {
        $limit= $request->get('limit');
        $data = UserStatistics::paginate($limit);
        return $data;
    }

    public function delHistoricalBill(Request $request)
    {
        $id = intval($request->get('id'));           
        $user = UserStatistics::find($id);
        $state = $user->delete();
        if ($state) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }
}
