@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'post/create']) !!}
    <div class="form-group">
        {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
    </div>
    <button type="submit" class="btn btn-success pull-right">
        <img src="/images/post.png" alt="投稿ボタン">
    </button>
{!! Form::close() !!}

<table>
@foreach ($list as $list)
            <tr>
                <td><img src="/images/{{ $list->images }}" alt="アイコン" class="icon"></td>
                <td>{{ $list->username }}</td>
                <td>{{ $list->posts }}</td>
                <td>{{ $list->created_at }}</td>

                @if($list->user_id === Auth::id()) <!-- if文 -->
                <td><a class="btn btn-primary modalopen" data-target="{{ $list->id }}" href=""><img src="/images/edit.png" alt="更新ボタン"></a></td>
                <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="/images/trash_h.png" alt="削除ボタン"></a></td>
                @endif
            </tr>

            <div class="upform" id="{{ $list->id }}">
                <form action="update" method="post">
                    @csrf <!-- セキュリティ　このフォームから送ったよ -->
                    <input type="text" name="update" value="{{ $list->posts }}">
                    <input type="hidden" name="upid" value="{{ $list->id }}">
                    <input type="image" src="/images/edit.png">
                </form>
            </div>
@endforeach
</table>


@endsection