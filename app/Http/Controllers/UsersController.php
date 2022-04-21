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

    public function myprofupdate(Request $request){ //Requestクラスを$requestとして扱う。画面から送られたものを扱う
        $upname = $request->input('username'); //$requestの中のinputメソッドを使う
        $upmail = $request->input('mailAdress');
        $uppass = $request->input('newPass');
        $upbio = $request->input('bio');
        $upicon = $request->file('icon');

        if(isset($uppass)){ //イズセット セットされてたら（値が入っていたら）
            DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'password' => bcrypt($uppass), //bcryptハッシュ化
                ]);
        }

        if(isset($upicon)){ //イズセット セットされてたら（値が入っていたら）
            $iconname = $upicon->getClientOriginalName(); //画像の名前抜き出し
            $upicon->storeAs('images', $iconname,'save'); //保存先のフォルダ名、画像の名前、保存方法
            //storeAsストアアズ…保存する
            //saveの方法で保存する　C:\xampp\htdocs\dawnSNS\config\filesystems.phpで設定している

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


    public function profile($id){ //選択した人のid
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
            ->toArray(); //配列にする
            //ddd($followerid);

        if(isset($search)){ //イズセット セットされてたら（値が入っていたら）
            //ログインしているユーザー以外と、入力したワードと一致するものを取得
            $users = DB::table('users')
            ->where('id','<>',Auth::id())//Auth::id()認証した。ログインした。
            //ログインしたidと一致していないユーザー
            ->where('username','like','%'.$search.'%') //$searchに入力したものがusernameの中で一致していたら
            //like…あいまい検索
            ->get();
        }else{ //ログインしているユーザー以外取得
            $users = DB::table('users')
            ->where('id','<>',Auth::id())//Auth認証した。ログインした。
            //ログインしたidと一致していないユーザー
            ->get();
        }

        return view('users.search',['users' => $users, 'followerid' => $followerid ,'search' => $search]); //右のものを左に入れている「左のものはなんですか。右です。」
    }
}
