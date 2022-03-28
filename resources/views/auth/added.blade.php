@extends('layouts.logout')

@section('content')

<div class="frameadded">
    <p class="added">{{session('username')}}さん、</p> <!-- 一時的に表示させる -->
    <p class="added">ようこそ！DAWNSNSへ！</p>
    <div class="addedwhile">
        <p class="addedleft">ユーザー登録が完了しました。</p>
        <p class="addedleft">さっそく、ログインをしてみましょう。</p>
    </div>
    <p class="btn">
        <a href="/login">ログイン画面へ</a>
    </p>
</div>

@endsection