<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PermissionSettingsController extends Controller
{
    public function addRole(Request $request)
    {
        if ($request->ajax()) {
            try {
                $request->validate([
                    'role_name' => 'required|unique:bg_roles'
                ]); 
            } catch (\Throwable $th) {
                return response()->json(['status'=>403]);
            }


            $role_name= $request->role_name;
       
            $id= DB::table('bg_roles')->insertGetId([
                'role_name'=>$role_name
            ]);
        
            if ($id) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
           
        }
    }

    public function queryRole()
    {
        $role_name= DB::table('bg_roles')->select('role_name')->get();

        if ($role_name) {
            return response()->json(['role_name'=>$role_name,'status'=>200]);
        }else{
            return response()->json(['role_name'=>$role_name,'status'=>403]);
        }
    }

    public function addRoleScope(Request $request)
    {
        if ($request->ajax()) {
            
            $id= DB::table('bg_roles')->where('role_name','=',$request->rolename)->update([
               'role_scope' => $request->limits,
               'describe' => $request->describe
            ]);
        
            if ($id) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
            
        }
    }

    public function queryRoleScope(Request $request)
    {
        if ($request->ajax()) {
            
            $data= DB::table('bg_roles')->where('role_name','=',$request->role_name)->value('role_scope');
        
            if ($data) {
                $data = json_decode($data,true);
                return response()->json(['status'=>200,'data'=>$data]);
            }else{
                return response()->json(['status'=>403]);
            }
            
        }
    }
}
