<?php

namespace App\Http\Controllers\Api;

use App\Model\Activity;
use App\Model\RotationChart;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function rotation()
    { 
        $data = RotationChart::where('state',1)->get(['img_url','jump_url','title','img_sort']);
        if ($data) {
            return response()->json([
                'code' => 200,
                'msg' =>"成功",
                'data' => $data
            ],200);
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"无数据",
            ],200);
        }
    }

    public function activity()
    {
        $data = Activity::where('activity_state',1)->get(['activity_type','activity_title',
        'activity_img','activity_url','activity_sort','start_time','stop_time']);

        if ($data) {
            return response()->json($data,200);
        }else {
            return response()->json([
                'code' => 0,
                'msg' =>"无数据",
            ],200);
        }
    }
}
