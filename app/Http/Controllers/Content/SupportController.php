<?php

namespace App\Http\Controllers\Content;

use App\Model\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function createSupport(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'app_img_url' => 'required|max:200',
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }
            if ($request->state == "on") {
                $state =1;
            }else{
                $state = 0;
            }
           

            $support= new Support;
           
            $support->app_img_url = $request->app_img_url;
            $support->icon_url = $request->icon_url;
            $support->title = $request->title;
            $support->first_line = $request->first_line;
            $support->second_line = $request->second_line;
            $support->button_text = $request->button_text;
            $support->link_url = $request->link_url;
            $support->sort = $request->sort;
            $support->state = $state;
            $id = $support->save();

            if ($id) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }  
        }
    }


    public function querySupport(Request $request)
    {
        $limit = $request->get('limit');
        $data = SUpport::paginate($limit);
        return $data;
    }

    public function updateSupport(Request $request)
    {
        if ($request->ajax()) {
            $support= Support::find($request->id);
            if ($request->state =="on") {
                $state = 1;
            }else{
                $state = 0;
            }
          
            $support->icon_url = $request->icon_url;
            $support->title = $request->title;
            $support->first_line = $request->first_line;
            $support->second_line = $request->second_line;
            $support->button_text = $request->button_text;
            $support->link_url = $request->link_url;
            $support->sort = $request->sort;
            $support->state = $state;
            $id = $support->save();

            if ($id) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }

    }

    public function delSupport(Request $request)
    {
        if ($request->ajax()) {
            $support = Support::find($request->id);
            $state= $support->delete();

            if ($state) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }
}
