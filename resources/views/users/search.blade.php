@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/search']) !!}
    <div class="form-group">
        {!! Form::input('text', 'search', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
    </div>
    <button type="submit" class="btn btn-success pull-right">
        <img src="/images/post.png" alt="検索ボタン">
    </button>
{!! Form::close() !!}

<table>
@foreach ($users as $user)
            <tr>
                <td><img src="/images/{{ $user->images }}" alt="アイコン"></td>
                <td>{{ $user->username }}</td>
                <td></td>
                <td></td>
            </tr>
@endforeach
</table>


@endsection