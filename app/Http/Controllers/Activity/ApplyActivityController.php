<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Model\ApplyActivity;
use Illuminate\Http\Request;

class ApplyActivityController extends Controller
{
    public function queryApplyList(Request $request)
    {
        $limit= $request->get('limit');
        $data= ApplyActivity::paginate($limit);
        return $data;
    }

    public function agreeApplyActivity(Request $request)
    {
        if ($request->ajax()) {
            $apply = ApplyActivity::find($request->id);
            $apply->state = 1;
            $status = $apply->save();
            if ($status) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function resuseApplyActivity(Request $request)
    {
        if ($request->ajax()) {
            $apply = ApplyActivity::find($request->id);
            $apply->state = 0;
            $status = $apply->save();
            if ($status) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }
}
