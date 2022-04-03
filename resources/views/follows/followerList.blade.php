@extends('layouts.login')

@section('content')
<p class="followerlist">Follower List</p>
<div class="list">
    @foreach($followers as $follower)
    <a href="{{ $follower->id }}/profile">
        <img src="/images/{{ $follower->images }}" alt="アイコン" class="icon">
    </a>
    @endforeach
</div>

<table>
@foreach ($followersPosts as $followersPost)
            <tr>
                <td><img src="/images/{{ $followersPost->images }}" alt="アイコン" class="icon"></td>
                <td>{{ $followersPost->username }}</td>
                <td>{{ $followersPost->posts }}</td>
                <td>{{ $followersPost->created_at }}</td>
            </tr>
@endforeach
</table>

@endsection