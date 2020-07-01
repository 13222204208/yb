<?php

namespace App\Http\Controllers\User;

use App\Model\UserInfo;
use App\Model\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountOperationController extends Controller
{
    public function searchUserNickname(Request $request)
    {
        if ($request->ajax()) {
            $nickname = UserInfo::where('username', $request->username)->value('nickname');

            if ($nickname) {
                return response()->json(['status' => 200, 'nickname' => $nickname]);
            } else {
                return response(['status' => 403]);
            }
        }
    }

    public function resetUserPhone(Request $request)
    {
        if ($request->ajax()) {
            $user = UserDetail::where('username', $request->username)->update(['phone' => ""]);

            if ($user) {
                return response()->json(['status' => 200]);
            } else {
                return response(['status' => 403]);
            }
        }
    }

    public function resetUserPassword(Request $request)
    {
        if ($request->ajax()) {
            $user = UserInfo::where('username', $request->username)->update(['password' => encrypt('0123456789')]);

            if ($user) {
                return response()->json(['status' => 200]);
            } else {
                return response(['status' => 403]);
            }
        }
    }

    public function resetUserTakePassword(Request $request)
    {
        if ($request->ajax()) {
            $user = UserInfo::where('username', $request->username)->update(['take_password' => encrypt('0123456789')]);

            if ($user) {
                return response()->json(['status' => 200]);
            } else {
                return response(['status' => 403]);
            }
        }
    }

    public function updateAccountStatus(Request $request) //帐号封禁状态
    {
        if ($request->ajax()) {
            $account_freeze = $request->account_freeze;

            if ($account_freeze == "forever") {
                $f_freeze_to_time = 999;
            } elseif ($account_freeze == "relieve") {
                $data = UserInfo::where('username', $request->username)->update(['account_freeze' => 0]);

                if ($data) {
                    return response()->json(['status' => 200]);
                } else {
                    return response()->json(['status' => 403]);
                }
            }

            $f_freeze_to_time = intval(time()) + intval($account_freeze) * 24 * 60 * 60;
            $f_freeze_to_time = date('Y-m-d H:i:s', $f_freeze_to_time);

            $data = UserInfo::where('username', $request->username)->update(['account_freeze' => $f_freeze_to_time]);

            if ($data) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }
}
