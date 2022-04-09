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
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('posts.id','posts.user_id','posts.posts','posts.created_at','users.username','users.images')
        ->orderBy('posts.created_at','desc') //順番
        ->get();
        //ddd($list); //画面に出力
        return view('posts.index',['list'=>$list]);//左の中に右がある
    }

    public function create(Request $request)
    {
        $post = $request->input('newPost'); //index.blade.phpのnewpost
        DB::table('posts')->insert([ //insertデータ入れる
            'posts' => $post,
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);

        return redirect('/top'); //移動
    }

    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
            return redirect('/top');
        }

    public function update(Request $request)
    {
        $id = $request->input('upid');
        $up_post = $request->input('update');
        DB::table('posts')
            ->where('id', $id)
            ->update([
                'posts' => $up_post,
                'updated_at' => now(),
                ]);

        return redirect('/top');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

}
