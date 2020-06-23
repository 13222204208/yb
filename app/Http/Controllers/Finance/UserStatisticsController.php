<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Model\UserStatistics;
use App\Http\Controllers\Controller;

class UserStatisticsController extends Controller
{
    public function queryUserStatistics(Request $request)
    {
        $limit= $request->get('limit'); 
        $data = UserStatistics::paginate($limit);
        return $data;
    }

    public function searchUserStatistics(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $data = UserStatistics::where('username',$username)->paginate($limit);
        return $data;
    }
}
