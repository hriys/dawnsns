<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function myprofile(){
        $myprofile = Auth::user();

        return view('users.myprofile',['myprofile' => $myprofile]);
    }

    public function myprofupdate(Request $request){
        $upname = $request->input('username');
        $upmail = $request->input('mailAdress');
        $uppass = $request->input('newPass');
        $upbio = $request->input('bio');
        $upicon = $request->file('icon');

        if(isset($uppass)){
            DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'password' => bcrypt($uppass),
                ]);
        }

        if(isset($upicon)){
            $iconname = $upicon->getClientOriginalName(); //画像の名前抜き出し
            $upicon->storeAs('images', $iconname,'save'); //保存先のフォルダ名、画像の名前、保存方法

            DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'images' => $iconname,
                ]);
        }

        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'username' => $upname,
                'mail' => $upmail,
                'bio' => $upbio,
            ]);

        return back(); //前のページに戻る
    }


    public function profile($id){
        $usersprof = DB::table('users')
            ->where('id',$id)
            ->first(); //getは全部、firstは1回だけ持ってくる

        $postsprof = DB::table('posts')
            ->join('users','users.id','=','posts.user_id') //usersテーブルとの結合
            ->where('posts.user_id',$id)
            ->select('users.images','users.username','posts.posts','posts.created_at')
            ->get();

        $followerid = DB::table('follows')
            ->where('follower',Auth::id())
            ->get()
            ->toArray();

        return view('users.profile',['usersprof' => $usersprof , 'postsprof' => $postsprof , 'followerid' => $followerid]);
    }

    public function search(Request $request){ //Request リクエストクラスから$requestとして扱う
        $search = $request->input('search');

        $followerid = DB::table('follows') //DBデータベース
            ->where('follower',Auth::id())
            ->get()
            ->toArray();
            //ddd($followerid);

        if(isset($search)){
            $users = DB::table('users')
            ->where('id','<>',Auth::id())//Auth認証した。ログインした。
            //ログインしたidと一致していないユーザー
            ->where('username','like','%'.$search.'%')
            ->get();    
        }else{
            $users = DB::table('users')
            ->where('id','<>',Auth::id())//Auth認証した。ログインした。
            //ログインしたidと一致していないユーザー
            ->get();
        }

        return view('users.search',['users' => $users, 'followerid' => $followerid ,'search' => $search]); //右のものを左に入れている「左のものはなんですか。右です。」
    }
}
