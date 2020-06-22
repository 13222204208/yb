<?php

namespace App\Http\Controllers\Feedback;

use App\Model\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeedbackListController extends Controller
{
    public function feedbackList(Request $request)
    {
        $limit = $request->get('limit');
        $data= DB::table('bg_feedback')->paginate($limit);
        return $data;
    }

    public function feedbackAgree(Request $request)
    {
        $feedback= Feedback::find($request->id);
        $feedback->state = "已采纳";
        $state = $feedback->save();

        if ($state) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }

    public function feedbackResuse(Request $request)
    {
        $feedback= Feedback::find($request->id);
        $feedback->state = "已读";
        $state = $feedback->save();

        if ($state) {
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>403]);
        }
    }
}
