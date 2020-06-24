<?php

namespace App\Http\Controllers\User;

use App\Model\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    public function queryUserList(Request $request)
    {
        $limit= $request->get('limit'); 
        $data = UserInfo::paginate($limit);
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
