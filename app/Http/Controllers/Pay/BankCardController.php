<?php

namespace App\Http\Controllers\Pay;

use App\Model\BankCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BankCardController extends Controller
{
    public function addBankCard(Request $request)
    {
        if ($request->ajax()) {
            if ($request->state == "on") {
                $request->state = 1;
            } else {
                $request->state = 0;
            }
            $bank = new BankCard;
            $bank->card_name = $request->card_name;
            $bank->bank_name = $request->bank_name;
            $bank->open_bank = $request->open_bank;
            $bank->card_num = $request->card_num;
            $bank->min_money = intval($request->min_money);
            $bank->max_money = intval($request->max_money);
            $bank->day_max_money = intval($request->day_max_money);
            $bank->state = intval($request->state);
            $bank->day_money = intval($request->day_money);
            $state = $bank->save();
            if ($state) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }

    public function queryBankCard(Request $request)
    {
        $limit = $request->get('limit');
        $data = DB::table('bg_bank_card')->paginate($limit);
        return $data;
    }

    public function delBankCard(Request $request)
    {
        if ($request->ajax()) {
            $bank = BankCard::find($request->id);
            $state = $bank->delete();
            if ($state) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }

    public function updateBankCard(Request $request)
    {
        if ($request->ajax()) {
            if ($request->state == "on") {
                $request->state = 1;
            } else {
                $request->state = 0;
            }
            $bank = BankCard::find($request->id);
            $bank->min_money = intval($request->min_money);
            $bank->max_money = intval($request->max_money);
            $bank->day_max_money = intval($request->day_max_money);
            $bank->state = intval($request->state);
            $state = $bank->save();
            if ($state) {
                return response()->json(['status' => 200,'state'=>$request->id]);
            } else {
                return response()->json(['status' => 403]);
            }
        }
    }
}
