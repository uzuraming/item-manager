@extends('layouts.app')

@section('content')

    <h1>id: {{ $room->id }} の部屋編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($room, ['route' => ['rooms.update', $room->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('room_name', '部屋名:') !!}
                    {!! Form::text('room_name', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection


