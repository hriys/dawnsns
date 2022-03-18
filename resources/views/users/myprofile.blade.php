@extends('layouts.login')

@section('content')

<div class="myprofile" >
    <form action="myprof" method="post" enctype="multipart/form-data">
        @csrf <!-- セキュリティ　このフォームから送ったよ -->
        <input type="text" name="username" value="{{ $myprofile->username }}">
        <input type="mail" name="mailAdress" value="{{ $myprofile->mail }}">
        <input type="password" name="nowPass" value="{{ $myprofile->password }}">
        <input type="password" name="newPass" value="">
        <textarea name="bio" cols="10" rows="2">{{ $myprofile->bio }}</textarea>
        <input type="file" name="icon" >
        <button type="submit">更新</button>
    </form>
</div>







@endsection