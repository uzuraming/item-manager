@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }}場所詳細新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model([$room, $place], ['route' => ['place_details.store', ['id' => $room->id, 'place_id' => $place->id]]]) !!}

                <div class="form-group">
                    {!! Form::label('place_detail_name', '部屋詳細の名前:') !!}
                    {!! Form::text('place_detail_name', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection