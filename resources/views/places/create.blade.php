@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }}場所新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($room, ['route' => ['places.store', $room->id]]) !!}

                <div class="form-group">
                    {!! Form::label('place_name', '部屋の名前:') !!}
                    {!! Form::text('place_name', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection