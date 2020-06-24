<?php

namespace App\Http\Controllers\Platform;

use App\Model\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformListController extends Controller
{
    public function queryPlatform(Request $request)
    {
        $limit = $request->get('limit');
        $data = Platform::paginate($limit);
        return $data;
    }

    public function uploadPlatformImg(Request $request)
    {
        $file = $request->file('file');
        $url_path = 'uploads\platformImg'; //广告图片目录
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
            $url_path= "uploads/platformImg";
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

    public function createPlatform(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'platform_img' => 'required|max:300',
                    'platform_name' => 'required|unique:bg_platform|max:30',
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }
   
            if ($request->state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }
            $platform= new Platform;
            $platform->platform_type = $request->platform_type;
            $platform->platform_name = $request->platform_name;
            $platform->show_name = $request->show_name;
            $platform->platform_sort = intval($request->platform_sort);
            $platform->platform_img = $request->platform_img;
            $platform->state = $state;

            $id = $platform->save();

            if ($id) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }  
        }
    }

    
    public function updatePlatform(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'platform_img' => 'required|max:300',
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }
   
            if ($request->state == "on") {
                $state = 1;
            }else{
                $state = 0;
            }

            $platform = Platform::find($request->id);
       /*      $platform->platform_type = $request->platform_type; */
            $platform->platform_name = $request->platform_name;
            $platform->show_name = $request->show_name;
            $platform->platform_sort = intval($request->platform_sort);
            $platform->platform_img = $request->platform_img;
            $platform->state = $state;

            $id = $platform->save();

            if ($id) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }  
        }
    }
}
