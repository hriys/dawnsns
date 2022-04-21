<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;


class FollowsController extends Controller
{
    //
    public function followList(){
        $follows = DB::table('follows')
            ->join('users','users.id','=','follows.follow') //usersテーブルとの結合
            ->where('follower', Auth::id()) //followerの中にログインしているアカウントがあるか
            ->select('users.id','users.images')
            ->get();

        $followsPosts = DB::table('follows')
            ->join('users','users.id','=','follows.follow') //usersテーブルの結合。一致しているか
            ->join('posts', 'users.id', '=', 'posts.user_id') //postsテーブルの結合。一致しているか
            ->where('follower', Auth::id())
            ->select('users.id','users.images','users.username','posts.posts','posts.created_at')
            ->get();

        return view('follows.followList',['follows' => $follows, 'followsPosts' => $followsPosts]);
    } //左の中に右がある

    public function followerList(){
        $followers = DB::table('follows')
            ->join('users','users.id','=','follows.follower') //usersテーブルとの結合
            ->where('follow', Auth::id())
            ->select('users.id','users.images')
            ->get();

        $followersPosts = DB::table('follows')
            ->join('users','users.id','=','follows.follower') //usersテーブルとの結合
            ->join('posts', 'users.id', '=', 'posts.user_id') //postsテーブルの結合
            ->where('follow', Auth::id())
            ->select('users.id','users.images','users.username','posts.posts','posts.created_at')
            ->get();

        return view('follows.followerList',['followers' => $followers, 'followersPosts' => $followersPosts]);
    }

    public function follow(Request $request){ //フォローするの部分
        $id = $request->input('followid'); //フォローボタン

        DB::table('follows')->insert([ //insertデータ入れる
            'follow' => $id,
            'follower' => Auth::id(), //今ログインしているID
            'created_at' => now(),
        ]);

        return back(); //前のページに戻る
    }

    public function unfollow(Request $request){ //フォローを外すの部分
        $id = $request->input('unfollowid'); //フォローを外すボタン

        DB::table('follows')
            ->where('follow', $id)
            ->where('follower',Auth::id())
            ->delete();

        return back(); //前のページに戻る
    }

}
