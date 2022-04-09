@extends('layouts.login')

@section('content')

<div class="myprofile" >
    <form action="myprof" method="post" enctype="multipart/form-data">
        @csrf <!-- セキュリティ　このフォームから送ったよ -->
        <div class="first">
            <img src="/images/{{$name->images}}" class="icon">
            <label for="">UserName</label>
            <input type="text" name="username" value="{{ $myprofile->username }}">
        </div>
        <div>
            <label for="">MailAdress</label>
            <input type="mail" name="mailAdress" value="{{ $myprofile->mail }}">
        </div>
        <div>
        <label for="">Password</label>
            <input type="password" name="nowPass" value="{{ $myprofile->password }}">
        </div>
        <div>
            <label for="">New Password</label>
            <input type="password" name="newPass" value="">
        </div>
        <div>
            <label for="">Bio</label>
            <textarea name="bio" cols="10" rows="2">{{ $myprofile->bio }}</textarea>
        </div>
        <div>
        <label for="">Icon Image</label>
            <input type="file" name="icon" >
        </div>
        <div>
            <button type="submit">更新</button>
        </div>
    </form>
</div>







@endsection