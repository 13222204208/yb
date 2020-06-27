<?php

namespace App\Http\Controllers\BgUser;

use App\Model\BgUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasicDocumentController extends Controller
{
    public function basicDocument()
    {
        if (session('id')) {
            $data = BgUser::find(session('id'));
            return response()->json(['status'=>200,'data'=>$data]);
        }else{
            return response()->json(['status'=>403]);
        }
        
    }

    public function setMypass(Request $request)
    {
        if (session('id')) {
            $user = BgUser::find(session('id'));
            if (!$user || decrypt($user->password) != $request->oldPassword) {
                return response()->json(['status'=>403]);
            }
            $user->password = encrypt($request->password);
            $state = $user->save();
            if ($state) {
                return response()->json(['status'=>200]); 
            }else{
                return response()->json(['status'=>403]);
            }
        }else{
            return response()->json(['status'=>403]);
        }
        
    }
}
