@extends('layouts.login')

@section('content')

<div class="post">
    {!! Form::open(['url' => 'post/create']) !!}
        <div class="flex">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
        <button type="submit" class="btn">
            <img src="/images/post.png" alt="投稿ボタン">
        </button>
        </div>
    {!! Form::close() !!}
</div>

<table>
@foreach ($list as $list) <!-- 複数(左)の中から単体(右)を取り出して使う -->
            <tr class="timeline">
                <td><img src="/images/{{ $list->images }}" alt="アイコン" class="icon"></td>
                <td>{{ $list->username }}</td>
                <td>{{ $list->posts }}</td>
                <td>{{ $list->created_at }}</td>

                @if($list->user_id === Auth::id()) <!-- if文 -->
                <td><a class="btn btn-primary modalopen" data-target="{{ $list->id }}" href=""><img src="/images/edit.png" alt="更新ボタン"></a></td> <!-- $list->id…各投稿のidが入っている -->
                <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="/images/trash_h.png" alt="削除ボタン"></a></td> <!-- $list->id…各投稿のidが入っている -->
                @endif
            </tr>

            <div id="{{ $list->id }}" class="bg"> <!-- $list->id…各投稿のidが入っている -->
                <div class="upform">
                    <form action="update" method="post">
                        @csrf <!-- セキュリティ　このフォームから送ったよ -->
                        <input type="text" name="update" value="{{ $list->posts }}"> <!-- 投稿内容が入っている -->
                        <input type="hidden" name="upid" value="{{ $list->id }}"> <!-- $list->id…各投稿のidが入っている -->
                        <input type="image" src="/images/edit.png"> <!-- inputで画像自体を送信ボタンにしている -->
                    </form>
                </div>
            </div>
@endforeach
</table>


@endsection