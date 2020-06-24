<?php

namespace App\Http\Controllers\Record;

use App\Model\Betting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginRecordController extends Controller
{
    public function queryLoginRecord(Request $request)
    {
        $limit = $request->get('limit');
        $data = Betting::paginate($limit);
        return $data;
    }

    public function searchLoginRecord(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $login_ip = $request->get('login_ip');
        $startTime = $request->get('startTime');
        $stopTime = $request->get('stopTime');

        $betting = new Betting;
        $data= $betting->when($login_ip, function ($query) use ($login_ip) {
            $query->where('login_ip','=', $login_ip);
        })->when($username, function ($query) use ($username) {
            $query->where('username', '=',$username);
        })->when($startTime, function ($query) use ($startTime,$stopTime) {
            $query->whereBetween('updated_at',[$startTime, $stopTime] ) ; 
        })->paginate($limit);
        return $data; 

    }
}
