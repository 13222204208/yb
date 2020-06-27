<?php

namespace App\Http\Controllers\News;

use App\Model\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SendNewsController extends Controller
{
    public function sendNews(Request $request)
    {
        if ($request->ajax()) {
             if ($request->username != "") {
               $state= DB::table('f_userinfo')->where('username',$request->username)->value('username');
               if (!$state) {
                 return response()->json(['status'=>404]);
               }
            } 

            $news = new News;
            $news->news_type = intval($request->news_type);
            $news->username = $request->username;
            $news->news_title = $request->news_title;
            $news->news_content = $request->news_content;
            $news->start_time = $request->start_time;
            $news->destroy_time = $request->destroy_time;
            $news->great_news = intval($request->great_news);
            $news->award_gold = $request->award_gold;
            $state = $news->save();
            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }
}
