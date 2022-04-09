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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:12|min:4',
            'mail' => 'required|string|email|max:50|min:5|unique:users',
            'password' => 'required|string|min:4|max:12|confirmed|alpha_num',
        ],[
            'required' => 'この項目は必須です。',
            'username.min' => '名前は4文字以上でお願いします。',
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
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }
//bcrypt ハッシュ化。文字列置き換える。


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            $validator = $this->validator($data);
            if ($validator->fails()) { //復習
                return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
            }else{
                $this->create($data);
                return redirect('added')->with('username',$data['username']);
            }

        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
