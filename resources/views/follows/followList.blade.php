@extends('layouts.login')

@section('content')
<p class="followlist">Follow List</p>
<div class="list">
    @foreach($follows as $follow) <!-- $follows（複数）の中から取り出したものを$follow（単体）として扱っている -->
    <a href="{{ $follow->id }}/profile">
        <img src="/images/{{ $follow->images }}" alt="アイコン" class="icon">
    </a>
    @endforeach
</div>

<table>
@foreach ($followsPosts as $followsPost)
            <tr>
                <td><img src="/images/{{ $followsPost->images }}" alt="アイコン" class="icon"></td>
                <td>{{ $followsPost->username }}</td>
                <td>{{ $followsPost->posts }}</td>
                <td>{{ $followsPost->created_at }}</td>
            </tr>
@endforeach
</table>


@endsection