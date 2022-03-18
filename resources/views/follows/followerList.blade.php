@extends('layouts.login')

@section('content')


@foreach($followers as $follower)
<a href="{{ $follower->id }}/profile">
    <img src="/images/{{ $follower->images }}" alt="アイコン">
</a>
@endforeach

<table>
@foreach ($followersPosts as $followersPost)
            <tr>
                <td><img src="/images/{{ $followersPost->images }}" alt="アイコン"></td>
                <td>{{ $followersPost->username }}</td>
                <td>{{ $followersPost->posts }}</td>
                <td>{{ $followersPost->created_at }}</td>
            </tr>
@endforeach
</table>

@endsection