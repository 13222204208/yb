<?php

namespace App\Http\Controllers\Pay;

use App\Model\WechatPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadController;

class WechatPayController extends Controller
{
    public function uploadWechatImg(Request $request)
    {
        $upload= new UploadController;
        $namePath= $upload->uploadImg($request->file('file'),'WechatImg');
        if ($namePath) {
            return response()->json(['path' =>$namePath, 'status' => 200]);
        } else {
            return response()->json(['path' =>$namePath, 'status' => 403]);
        }    

    }

    public function createWechatPay(Request $request)
    {
        if ($request->ajax()) {
            if ($request->state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }
            $wechat = new WechatPay;
            $wechat->wechat_name = $request->wechat_name;
            $wechat->wechat_url = $request->wechat_url;
            $wechat->min_money = intval($request->min_money);
            $wechat->max_money = intval($request->max_money);
            $wechat->day_max_money = intval($request->day_max_money);
            $wechat->state = intval($state);
            $wechat->day_money = intval($request->day_money);
            $status = $wechat->save();

            if ($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }    
        }
    }

    public function queryWechat(Request $request)
    {
        $limit = $request->get('limit');
        $data = DB::table('bg_wechat_pay')->paginate($limit);
        return $data;
    }

    public function delWechat(Request $request)
    {
        if ($request->ajax()) {
            $wechat = WechatPay::find($request->id);
            $status= $wechat->delete();

            if ($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }    
        }
    }

    public function updateWechat(Request $request)
    {
        if ($request->ajax()) {
            if ($request->state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }
            $wechat = WechatPay::find($request->id);
            $wechat->wechat_name = $request->wechat_name;
            $wechat->min_money = intval($request->min_money);
            $wechat->max_money = intval($request->max_money);
            $wechat->day_max_money = intval($request->day_max_money);
            $wechat->state = intval($state);
            $wechat->day_money = intval($request->day_money);
            $status = $wechat->save();

            if ($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }    
        }
    }
}
