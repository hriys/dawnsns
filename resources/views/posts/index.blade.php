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
                <td><img src="/images/{{ $list->images }}" alt="アイコン"></td>
                <td>{{ $list->username }}</td>
                <td>{{ $list->posts }}</td>
                <td>{{ $list->created_at }}</td>

                <td><a class="btn btn-primary" href="/post/{{$list->id}}/update-form" onclick="return confirm({{ $list->id }})"><img src="/images/edit.png" alt="更新ボタン"></a></td>
                <td><a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('このつぶやきを削除します。よろしいでしょうか？')"><img src="/images/trash_h.png" alt="削除ボタン"></a></td>
            </tr>
@endforeach
</table>

@endsection