<?php

namespace App\Http\Controllers\Login;

use App\Model\BgUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class loginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $account_num= $request->username;
        
            $user = BgUser::where('account_num', $account_num)->first();
        
            if (!$user || decrypt($user->password) != $request->password) {
                return response()->json(['status'=>403]);
            }
            session(['nickname' => $user->nickname]); 
            session(['id' => $user->id]); 
        
            $response = [
                'status'=>200
            ];
        
            return response($response);
        }
    }
}
