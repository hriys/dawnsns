@extends('layouts.login')

@section('content')

<div>
    <img src="/images/{{ $usersprof->images }}" alt="">
    <p><span>Name</span>{{ $usersprof->username }}</p>
    <p><span>Bio</span>{{ $usersprof->bio }}</p>

@if(!in_array($usersprof->id,array_column($followerid,'follow')))
<!-- $usersprof->idが$followeridのfollowに入ってなかったら -->
    <td>
        <form action="/follow" method="post">
            @csrf
            <input type="hidden" name="followid" value="{{ $usersprof->id }}"> <!-- プロフィール画面の人のid -->
            <input type="submit" value="フォローする">
        </form>
    </td>
@else
<!-- $usersprof->idが$followeridのfollowに入ってたら -->

    <td>
        <form action="/unfollow" method="post">
            @csrf
            <input type="hidden" name="unfollowid" value="{{ $usersprof->id }}">
            <input type="submit" value="フォローを外す">
        </form>
    </td>
@endif
</div>



@foreach($postsprof as $postsprof)
<div>
    <img src="/images/{{ $postsprof->images }}" alt="">
    <p>{{ $postsprof->username }}</p>
    <p>{{ $postsprof->posts }}</p>
    <p>{{ $postsprof->created_at }}</p>
</div>
@endforeach



@endsection