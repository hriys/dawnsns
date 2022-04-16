<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    //public function index(){
    //    return view('posts.index');
    //}

    public function index()
    {
        $list = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id') //usersテーブルと結合して、users.idとposts.user_idを一致する者同士で結合
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->orderBy('posts.created_at','desc') //順番の指定。desc（降順）でかいので（de）
        //昇順(ASC)蟻のように小さい
        ->get();//取得する
        //ddd($list); //画面に出力
        return view('posts.index',['list'=>$list]);//左の中に右がある
        //postsフォルダのindex.blade.php
    }

    public function create(Request $request)
    {
        $post = $request->input('newPost'); //index.blade.phpのnewpost(投稿フォーム)
        DB::table('posts')->insert([ //insertインサート。データ入れる
            'posts' => $post, //$postを'posts'に入れる
            'user_id' => Auth::id(), //ログインしているID
            'created_at' => now(),
        ]);

        return redirect('/top'); //redirectリダイレクト…このURLに飛ぶ
    }

    public function update(Request $request)
    {
        $id = $request->input('upid'); //inputタグのupid
        $up_post = $request->input('update'); //inputタグのupdate
        DB::table('posts')
            ->where('id', $id) //$idとidが一致していたら
            ->update([ //一致していたら更新する
                'posts' => $up_post,
                'updated_at' => now(),
                ]);

        return redirect('/top');
    }

    public function delete($id) //選択されたid、投稿内容
    {
        DB::table('posts') //postテーブルの
            ->where('id', $id) //postのidと選択されたidが一致
            ->delete(); //削除する

        return redirect('/top'); //redirectリダイレクト…このURLに飛ぶ
    }

}
