@extends('layouts.logout')

@section('content')

<div class="frame">
    {!! Form::open() !!}

    <p>DAWNSNSへようこそ</p>

    <div class="login">
        {{ Form::label('e-mail') }}
        {{ Form::text('mail',null,['class' => 'input']) }}
    </div>
    <div class="login">
        {{ Form::label('password') }}
        {{ Form::password('password',['class' => 'input']) }}
    </div>

    <div class="button">
        {{ Form::submit('LOGIN', ['class' => 'logbtn']) }}
    </div>

    <p class="register">
        <a href="/register">新規ユーザーの方はこちら</a>
    </p>

    {!! Form::close() !!}
</div>

@endsection
