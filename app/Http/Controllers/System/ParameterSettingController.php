<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Model\MemberRecharge;
use App\Model\MemberDrawMoney;
use App\Http\Controllers\Controller;

class ParameterSettingController extends Controller
{
    public function updateMemberRecharge(Request $request)
    {
        if ($request->ajax()) {
           
            $state= MemberRecharge::updateOrCreate(
                ['id'=>1],
                ['min_money'=>$request->min_money,'largess_scale'=>$request->largess_scale,'largess_toplimit'=>$request->largess_toplimit]      
            );

            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryMemberRecharge()
    {
        $data= MemberRecharge::find(1);

        if ($data) {
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function updateDrawMoney(Request $request)
    {
        if ($request->ajax()) {
           
            $state= MemberDrawMoney::updateOrCreate(
                ['id'=>1],
                ['draw_money_num'=>$request->draw_money_num,
                'min_draw_money'=>$request->min_draw_money,
                'max_draw_money'=>$request->max_draw_money,
                'draw_money_scale'=>$request->draw_money_scale,
                'poundage_full'=>$request->poundage_full,               
                ]      
            );

            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryDrawMoney()
    {
        $data= MemberDrawMoney::find(1);

        if ($data) {
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
    }
}
