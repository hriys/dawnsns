@extends('layouts.login')

@section('content')

@foreach($follows as $follow)
<a href="{{ $follow->id }}/profile">
    <img src="/images/{{ $follow->images }}" alt="アイコン">
</a>
@endforeach

<table>
@foreach ($followsPosts as $followsPost)
            <tr>
                <td><img src="/images/{{ $followsPost->images }}" alt="アイコン"></td>
                <td>{{ $followsPost->username }}</td>
                <td>{{ $followsPost->posts }}</td>
                <td>{{ $followsPost->created_at }}</td>
            </tr>
@endforeach
</table>


@endsection