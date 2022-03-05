@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('Username') }}
{{ Form::text('username',null,['class' => 'input']) }}
@if($errors->has('username'))
{{$errors->first('username')}}
@endif

{{ Form::label('MailAdress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@if($errors->has('mail'))
{{$errors->first('mail')}}
@endif

{{ Form::label('Password') }}
{{ Form::password('password',null,['class' => 'input']) }}
@if($errors->has('password'))
{{$errors->first('password')}}
@endif

{{ Form::label('password_confirmation') }}
{{ Form::password('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection