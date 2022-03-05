<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(Request $request){
        $search = $request->input('search');

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

        return view('users.search',['users' => $users]);
    }
}
