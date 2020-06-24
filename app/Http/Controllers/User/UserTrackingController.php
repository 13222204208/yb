<?php

namespace App\Http\Controllers\User;

use App\Model\Betting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTrackingController extends Controller
{
    public function queryTracking(Request $request)
    {
        $limit= $request->get('limit');
        $data = Betting::paginate($limit);
        return $data;
    }

    public function searchTracking(Request $request)
    {
        $limit= $request->get('limit'); 
        $username = $request->get('username');
        $data = Betting::where('username',$username)->paginate($limit);
        return $data;
    }
}
