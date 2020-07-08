<?php

namespace App\Http\Controllers\News;

use App\Model\News;
use App\Model\Notice;
use App\Model\Affiche;
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
            if ($request->username) {
                $news->username = $request->username;
            }
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

    public function sendAffiche(Request $request)
    {
        if ($request->ajax()) {
            $affiche= new Affiche;
            $affiche->affiche_title = $request->affiche_title;
            $affiche->affiche_content = $request->affiche_content;
            $affiche->great_affiche = intval($request->great_affiche);
            $state = $affiche->save();
            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryAffiche(Request $request)
    {
        $limit = $request->get('limit');
        $data= Affiche::paginate($limit);
        return $data;
    }

    public function delAffiche(Request $request)
    {
        if ($request->ajax()) {
            $state = Affiche::find($request->id)->delete();
            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function sendNotice(Request $request)
    {
        if ($request->ajax()) {
            $notice= new Notice;
            $notice->notice_title = $request->notice_title;
            $notice->notice_content = $request->notice_content;
            $state = $notice->save();
            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }

    public function queryNotice(Request $request)
    {
        $limit = $request->get('limit');
        $data= Notice::where('notice_receive','all')->paginate($limit);
        return $data;
    }

    public function delNotice(Request $request)
    {
        if ($request->ajax()) {
            $state = Notice::find($request->id)->delete();
            if ($state) {
                return response()->json(['status'=>200]);
            }else{
                return response()->json(['status'=>403]);
            }
        }
    }
}
