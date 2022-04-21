<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use DB;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //ログインしていない場合は、ログイン画面へ移動する
        $this->middleware('auth');
        // 全てのページで共通に使える情報をビューに送る
        $this->middleware(function ($request, $next) {
            $followcount =  DB::table('follows')
                ->where('follower',Auth::id())
                ->count();

            $followercount = DB::table('follows')
                ->where('follow' ,Auth::id())
                ->count();

        //view::share すべてのviewに反映させる
        View::share('name', Auth::user()); //左は変数、右は値
        View::share('followcount', $followcount); //フォロー数
        View::share('followercount', $followercount);

        return $next($request);
        });
    }

}
