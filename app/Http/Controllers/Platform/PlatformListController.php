<?php

namespace App\Http\Controllers\Platform;

use App\Model\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadController;

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
        $upload= new UploadController;
        $namePath= $upload->uploadImg($request->file('file'),'PlatformImg');
        if ($namePath) {
            return response()->json(['path' =>$namePath, 'status' => 200]);
        } else {
            return response()->json(['path' =>$namePath, 'status' => 403]);
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
