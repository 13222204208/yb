<?php

namespace App\Http\Controllers\Activity;

use App\Model\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function uploadActivityImg(Request $request)
    {
        $file = $request->file('file');
        $url_path = 'uploads/activityImg'; //广告图片目录
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
            $url_path= "uploads/activityImg";
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

    public function createActivity(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'activity_img' => 'required|max:200',
                    'activity_sort' => 'required|max:8',
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }
   
            $activity= new Activity;
            $activity->activity_type = $request->activity_type;
            $activity->application_mode = $request->application_mode;
            $activity->activity_title = $request->activity_title;
            $activity->activity_url = $request->activity_url;
            $activity->activity_sort = intval($request->activity_sort);
            $activity->activity_img = $request->activity_img;
            $activity->start_time = $request->start_time;
            $activity->stop_time = $request->stop_time;
            $activity->activity_term = $request->activity_term;
            $activity->term_num = $request->term_num;
            $activity->award_num = intval($request->award_num);
            $activity->activity_describe = $request->activity_describe;

            $id = $activity->save();

            if ($id) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }  
        }
    }

    public function queryActivityList(Request $request)
    {
        $limit= $request->get('limit');
        $data= DB::table('bg_activity')->paginate($limit);
        return $data;
    }

    public function updateActivity(Request $request)
    {
        if ($request->ajax()) {

            if ($request->activity_state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }
            $activity=  Activity::find($request->id);
            $activity->activity_type = $request->activity_type;
            $activity->application_mode = $request->application_mode;
            $activity->activity_title = $request->activity_title;
            $activity->activity_url = $request->activity_url;
            $activity->activity_sort = intval($request->activity_sort);
            $activity->activity_img = $request->activity_img;
            $activity->start_time = $request->start_time;
            $activity->stop_time = $request->stop_time;
            $activity->activity_term = $request->activity_term;
            $activity->term_num = $request->term_num;
            $activity->award_num = intval($request->award_num);
            $activity->activity_describe = $request->activity_describe;
            $activity->activity_state = $state;

            $id = $activity->save();

            if ($id) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }  
        }
    }

    public function delActivity(Request $request)
    {
        if ($request->ajax()) {
            $activity=  Activity::find($request->id);
            $state= $activity->delete();
            if ($state) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }  
        }
    }
}
