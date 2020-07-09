<?php

namespace App\Http\Controllers\Api;

use App\Model\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function platformList()
    {
        $data = Platform::where('state',1)->get(['platform_name','id']);

        if ($data) {
            return response()->json( ['msg'=>'成功','data'=>$data,'code'=>200]);
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"无数据",
            ],200);
        }
    }
}
