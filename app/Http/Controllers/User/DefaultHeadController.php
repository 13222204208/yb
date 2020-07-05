<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadController;

class DefaultHeadController extends Controller
{
    public function defaultHead(Request $request)
    {
        $upload= new UploadController;
        $namePath= $upload->uploadImg($request->file('file'),'UserHeadImg');
        $namePath = 'http://'.$_SERVER['HTTP_HOST'].'/'.$namePath;

        return response()->json(['status'=>200,'path'=>$namePath]);
    }

    public function createDefaultHead(Request $request)
    {
        if ($request->ajax()) {
            $id= DB::table('f_default_head')->insertGetId([
                'default_head'=>$request->default_head
            ]);
            if ($id) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryDefaultHead(Request $request)
    {
        $limit= $request->get('limit');
        $data = DB::table('f_default_head')->paginate($limit);
        return $data;
    }

    public function delDefaultHead(Request $request)
    {
        if ($request->ajax()) {
            $state = DB::table('f_default_head')->where('id',$request->id)->delete();
            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }
}
