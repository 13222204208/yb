<?php

namespace App\Http\Controllers\Api;

use App\Model\BankCard;
use Illuminate\Http\Request;
use App\Http\Requests\CardRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function addCard(CardRequest $request)
    {
        $card = new BankCard;
        $user = JWTAuth::authenticate($request->token);

        $card->username = $user->username;
        $card->card_name = $request->card_name;
        $card->bank_name = $request->bank_name;
        $card->open_bank = $request->open_bank;
        $card->card_num = $request->card_num;

        $state = $card->save();


        if ($state) {
            return response()->json(['msg' => '成功','code' => 200],200);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => "失败",
            ], 200);
        }
    }
}
