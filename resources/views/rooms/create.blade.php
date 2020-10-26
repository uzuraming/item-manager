@extends('layouts.app')

@section('content')

    <h1>部屋新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($room, ['route' => 'rooms.store']) !!}

                <div class="form-group">
                    {!! Form::label('room_name', '部屋名:') !!}
                    {!! Form::text('room_name', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('作成', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection