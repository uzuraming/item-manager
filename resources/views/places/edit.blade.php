@extends('layouts.app')

@section('content')

    <h1>id: {{ $place->place_name }} の名前編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model([$room, $place], ['route' => ['places.update', ['id' => $room->id, 'place_id' => $place->room_id]], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('place_name', '場所の名前:') !!}
                    {!! Form::text('place_name', $place->place_name, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection