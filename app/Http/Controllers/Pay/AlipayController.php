<?php

namespace App\Http\Controllers\Pay;

use App\Model\Alipay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AlipayController extends Controller
{
    public function uploadAlipayImg(Request $request)
    {
        $file = $request->file('file');
        $url_path = 'uploads\alipayImg';
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
            $url_path= "uploads/alipayImg";
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

    public function createAlipay(Request $request)
    {
        if ($request->ajax()) {
            if ($request->state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }
            $alipay = new Alipay;
            $alipay->alipay_name = $request->alipay_name;
            $alipay->alipay_url = $request->alipay_url;
            $alipay->min_money = intval($request->min_money);
            $alipay->max_money = intval($request->max_money);
            $alipay->day_max_money = intval($request->day_max_money);
            $alipay->state = intval($state);
            $alipay->day_money = intval($request->day_money);
            $status = $alipay->save();

            if ($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }    
        }
    }

    public function queryAlipay(Request $request)
    {
        $limit = $request->get('limit');
        $data = DB::table('bg_alipay')->paginate($limit);
        return $data;
    }

    public function delAlipay(Request $request)
    {
        if ($request->ajax()) {
            $alipay = Alipay::find($request->id);
            $status= $alipay->delete();

            if ($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }    
        }
    }

    public function updateAlipay(Request $request)
    {
        if ($request->ajax()) {
            if ($request->state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }
            $alipay = Alipay::find($request->id);
            $alipay->alipay_name = $request->alipay_name;
            $alipay->min_money = intval($request->min_money);
            $alipay->max_money = intval($request->max_money);
            $alipay->day_max_money = intval($request->day_max_money);
            $alipay->state = intval($state);
            $alipay->day_money = intval($request->day_money);
            $status = $alipay->save();

            if ($status) {
                return response()->json([ 'status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }    
        }
    }
}
