<?php

namespace App\Http\Controllers\User;

use App\Model\LoginRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LossStatisticsController extends Controller
{
    public function queryUserLoss(Request $request)
    {
        $limit = $request->get('limit');
        $date= intval(time()) - 15 * 24 * 60 * 60;
        $date= date('Y-m-d H:i:s', $date);
        $data= LoginRecord::where('login_time','<',$date)->paginate($limit);
        return $data;
    }
}
