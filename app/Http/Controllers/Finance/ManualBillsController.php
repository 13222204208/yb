<?php

namespace App\Http\Controllers\Finance;

use App\Model\ManualBills;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManualBillsController extends Controller
{
    public function addManualBills(Request $request)
    {
        if ($request->ajax()) {
            $manual = new ManualBills;
            $manual->time = $request->time;
            $manual->business_type = $request->business_type;
            $manual->bank_card = $request->bank_card;
            $manual->operation = $request->operation;
            $manual->remarks = $request->remarks;
            $state = $manual->save();
            if($state){
                return response()->json(['status'=>200]);
            }else{
                return false;
            }
        }
    }
}
