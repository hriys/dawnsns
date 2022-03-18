@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/search']) !!} <!-- フォームファサード -->
    <div class="form-group">
        {!! Form::input('text', 'search', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
    </div>
    <button type="submit" class="btn btn-success pull-right">
        <img src="/images/post.png" alt="検索ボタン">
    </button>
{!! Form::close() !!}

<table>
@foreach ($users as $user) <!-- $usersは大きい袋(中に個包装が入っている) $userは大きい袋の中の個包装-->
            <tr>
                <td><img src="/images/{{ $user->images }}" alt="アイコン"></td>
                <td>{{ $user->username }}</td>
                @if(!in_array($user->id,array_column($followerid,'follow')))
                <td>
                    <form action="/follow" method="post">
                        @csrf
                        <input type="hidden" name="followid" value="{{ $user->id }}">
                        <input type="submit" value="フォローする">
                    </form>
                </td>
                @else
                <td>
                    <form action="/unfollow" method="post">
                        @csrf
                        <input type="hidden" name="unfollowid" value="{{ $user->id }}">
                        <input type="submit" value="フォローを外す">
                    </form>
                </td>
                @endif
            </tr>
@endforeach
</table>


@endsection