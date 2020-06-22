<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BackgroundAccountController extends Controller
{
    public function addAccount(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'account_num' => 'required|unique:bg_users|max:12',
                    'nickname' => 'required|unique:bg_users|max:12',
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }

       
            $id= DB::table('bg_users')->insertGetId([
                'account_num'=>$request->input('account_num'),
                'nickname'=>$request->input('nickname'),
                'password'=>encrypt($request->input('password')),
                'role'=>$request->input('role_name'),
            ]);
        
            if ($id) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
           
        }
    }

    public function queryAccount(Request $request)
    {
        $limit = $request->get('limit');
        $data= DB::table('bg_users')->select('id','account_num','nickname','role','state')->paginate($limit);
        return $data;
    }

    public function queryOneAccount(Request $request,$account_num)
    {
        $limit = $request->get('limit');
        $data= DB::table('bg_users')->where('account_num',$account_num)->select('id','account_num','nickname','role','state')->paginate($limit);
        return $data;
    }

    public function queryAccountRole(Request $request,$role)
    {
        $limit = $request->get('limit');
        $data= DB::table('bg_users')->where('role','=',$role)->select('id','account_num','nickname','role','state')->paginate($limit);
        return $data;
    }

    public function delAccount(Request $request)
    {
        if ($request->ajax()) {
            $id= $request->input('id');
            $state= DB::table('bg_users')->where('id',$id)->delete();
        }

        if ($state) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function updateAccount(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'state' => 'max:300',
                    'nickname' => 'required|max:16',
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }

            $state = DB::table('bg_users')->where('id',$request->id)->update([
                'nickname'=>$request->nickname,
                'role'=>$request->role,
                'state'=>$request->state
            ]);

            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }
}
