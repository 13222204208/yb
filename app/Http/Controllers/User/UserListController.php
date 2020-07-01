<?php

namespace App\Http\Controllers\User;

use App\Model\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    public function queryUserList(Request $request)
    {
        $limit= $request->get('limit'); 
        //$data = UserInfo::paginate($limit);
        $data= DB::table('f_userinfo')
            ->leftJoin('f_user_detail', 'f_userinfo.username', '=', 'f_user_detail.username')
            ->paginate($limit);
        return $data;
    }

    public function searchUserList(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $data = UserInfo::where('username',$username)->paginate($limit);
        return $data;
    }
}
