<?php

namespace App\Http\Controllers\Pay;

use App\Model\WechatPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WechatPayController extends Controller
{
    public function uploadWechatImg(Request $request)
    {
        $file = $request->file('file');
        $url_path = 'uploads/wechatImg'; //轮播图片目录
        $rule = ['jpg', 'png', 'gif', 'jpeg'];
        if ($file->isValid()) {
            $clientName = $file->getClientOriginalName();
            $tmpName = $file->getFileName();
            $realPath = $file->getRealPath();
            $entension = $file->getClientOriginalExtension();
            if (!in_array($entension, $rule)) {
                return '图片格式为jpg,png,gif,jpeg';
            }
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $path = $file->move($url_path, $newName);
            $url_path= "uploads/wechatImg";
            $namePath = $url_path . '/' . $newName;
           
            if ($namePath) {
                return response()->json(['path' =>$namePath, 'status' => 200]);
            } else {
                return response()->json(['path' =>$namePath, 'status' => 403]);
            }    
         
        } else {
            return response()->json(['status' => 403]);
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
