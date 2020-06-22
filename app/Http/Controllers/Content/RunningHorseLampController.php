<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RunningHorseLampController extends Controller
{
    public function createRunHorse(Request $request)
    {
        if ($request->ajax()) {
            $id= DB::table('bg_run_horse')->insertGetId([
                'content'=>$request->content,
                'type'=>$request->type,
                'start_time'=>$request->start_time,
                'stop_time'=>$request->stop_time
            ]);

            if ($id) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryRunHorse(Request $request)
    {
        $limit= $request->get('limit');
        $data= DB::table('bg_run_horse')->paginate($limit);
        return $data;
    }
}
