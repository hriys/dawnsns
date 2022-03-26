@extends('layouts.logout')

@section('content')

<div class="frame">
    {!! Form::open() !!}

    <h2>新規ユーザー登録</h2>

    <div class="login">
        {{ Form::label('Username') }}
        {{ Form::text('username',null,['class' => 'input']) }}
        @if($errors->has('username'))
        {{$errors->first('username')}}
        @endif
    </div>

    <div class="login">
        {{ Form::label('MailAdress') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
        @if($errors->has('mail'))
        {{$errors->first('mail')}}
        @endif
    </div>

    <div class="login">
        {{ Form::label('Password') }}
        {{ Form::password('password',null,['class' => 'input']) }}
        @if($errors->has('password'))
        {{$errors->first('password')}}
        @endif
    </div>

    <div class="login">
        {{ Form::label('password_confirmation') }}
        {{ Form::password('password_confirmation',null,['class' => 'input']) }}
    </div>

    <div class="button">
        {{ Form::submit('REGISTER', ['class' => 'logbtn']) }}
    </div>

    <p class="register">
        <a href="/login">ログイン画面へ戻る</a>
    </p>

    {!! Form::close() !!}
</div>


@endsection