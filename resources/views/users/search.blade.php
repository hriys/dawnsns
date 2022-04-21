@extends('layouts.login')

@section('content')

<div class="usersearch">
{!! Form::open(['url' => '/search']) !!} <!-- フォームファサード -->
<div class="flex">
        {!! Form::input('text', 'search', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
    <button type="submit" class="btn">
        <img src="/images/post.png" alt="検索ボタン">
    </button>
    <div class="searchword">
        <!-- 検索ワード表示 -->
        <p>検索ワード:{{ $search }}</p>
    </div>
</div>
{!! Form::close() !!}
</div>


<table>
@foreach ($users as $user) <!-- $usersは大きい袋(中に個包装が入っている) $userは大きい袋の中の個包装-->
            <tr>
                <td><img src="/images/{{ $user->images }}" alt="アイコン" class="icon"></td>
                <td>{{ $user->username }}</td>
                @if(!in_array($user->id,array_column($followerid,'follow')))<!-- array_columnアライカラム。項目 -->
                <!-- $user->idが$followeridのfollowに入ってなかったら -->
                <td>
                    <form action="/follow" method="post">
                        @csrf
                        <input type="hidden" name="followid" value="{{ $user->id }}">
                        <input type="submit" value="フォローする" class="searchfollow">
                    </form>
                </td>
                @else <!-- $user->idが$followeridのfollowに入ってたら -->
                <td>
                    <form action="/unfollow" method="post">
                        @csrf
                        <input type="hidden" name="unfollowid" value="{{ $user->id }}">
                        <input type="submit" value="フォローを外す" class="searchunfollow">
                    </form>
                </td>
                @endif
            </tr>
@endforeach
</table>


@endsection