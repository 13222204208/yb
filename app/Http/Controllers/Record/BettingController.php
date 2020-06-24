<?php

namespace App\Http\Controllers\Record;

use App\Model\Betting;
use App\Model\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BettingController extends Controller
{
    public function queryBetting(Request $request)
    {
        $limit = $request->get('limit');
        $data = Betting::paginate($limit);
        return $data;
    }

    public function queryPlatformName()
    {
        $data= Platform::get('platform_name');
        if ($data) {
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function searchBetting(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $platform_name = $request->get('platform_name');
        $startTime = $request->get('startTime');
        $stopTime = $request->get('stopTime');

        $betting = new Betting;
        $data= $betting->when($platform_name, function ($query) use ($platform_name) {
            $query->where('platform_name','=', $platform_name);
        })->when($username, function ($query) use ($username) {
            $query->where('username', '=',$username);
        })->when($startTime, function ($query) use ($startTime,$stopTime) {
            $query->whereBetween('bottom_pour_time',[$startTime, $stopTime] ) ; 
        })->paginate($limit);
        return $data; 

    }
}
