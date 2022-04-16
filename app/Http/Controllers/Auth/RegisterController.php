<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) //バリデーター。（受け取り方の設定 受け取ったものを何と扱うか）
    //99行目の配列の$dataを受け取って、右の$dataとして扱う。
    {
        return Validator::make($data, [ //Validator::make…バリデーターメイク。ルールにあっているか見る
            'username' => 'required|string|max:12|min:4', //必須、文字、4文字以上12文字以下
            'mail' => 'required|string|email|max:50|min:5|unique:users', //mailメールかどうか
            //unique:usersユニークユーザーズ。Usersテーブルに同じものがあるか。あったらはじかれる
            'password' => 'required|string|min:4|max:12|confirmed|alpha_num', //confirmedコンファメッド。確認用と合っているか
            //alpha_numアルファベットと数字かどうか
        ],[
            'required' => 'この項目は必須です。', //リクアイアード
            'username.min' => '名前は4文字以上でお願いします。', //文字数少なかったら
            'username.max' => '名前は12文字以内でお願いします。',
            'email' => 'メールアドレスを入れてください。',
            'mail.min' => '5文字以上でお願いします。',
            'mail.max' => '50文字以内でお願いします。',
            'unique' => 'そのメールアドレスは既に使われています。',
            'password.min' => 'パスワードは4文字以上でお願いします。',
            'password.max' => 'パスワードは12文字以内でお願いします。',
            'confirmed' => '確認用パスワードと一致しません。',
            'alpha_num' => '英数字でお願いします。'
        ]);
    }
    //validator バリテーションをするメソッド

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([ //Usersテーブルに作成する
            'username' => $data['username'], //$data['username']を'username'に入れる
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),//ビークリプト
        ]);
    }
//bcrypt ハッシュ化。文字列置き換える。


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){ //メソッド
        //Requestクラスを$Requestとして扱う
        if($request->isMethod('post')){ //isMethod('post')…イズメソッド。post通信だったら
            //post通信…フォームとかから送られたもの
            $data = $request->input(); //$request…画面から送られたもの。入力データやPDFや音楽データなど。
            //input()…入力されたもの。()の中に何もない場合はすべて。

            $validator = $this->validator($data); //$validatorの中に49行目のvalidatorメソッドの処理結果を入れている
            if ($validator->fails()) { //fails処理結果がひっかかったら。ダメだったら。
                return redirect('/register') //redirectリダイレクト…このURLに飛ぶ
                        ->withErrors($validator) //$validatorのエラー内容を持っていく
                        ->withInput();//入力したデータも持っていく
            }else{ //引っかからなかったら。入力項目がOKだったら
                $this->create($data); //80行目のcreateメソッドの処理をする
                return redirect('added')->with('username',$data['username']);
                //URLは'added'に移動。$data['username']を'username'として持っていく
            }

        }
        return view('auth.register'); //get通信の処理の場合
    }

    public function added(){
        return view('auth.added');
    }
}
