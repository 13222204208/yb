<?php

namespace App\Http\Controllers\Pay;

use App\Model\PayClear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayClearController extends Controller
{
    public function updateOpenState(Request $request)
    {
        if ($request->ajax()) {
           
            $state= PayClear::updateOrCreate(
                ['id'=>1],
                ['bank_card'=>intval($request->bank_card),'wechat_pay'=>intval($request->wechat_pay),
                'alipay_pay'=>intval($request->alipay_pay),'third_party'=>intval($request->third_party)]      
            );

            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryOpenState()
    {
        $data= PayClear::find(1);

        if ($data) {
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
    }
}
