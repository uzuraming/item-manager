@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}物品新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model([$item], ['route' => ['items.store', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]]]) !!}

                <div class="form-group">
                    {!! Form::label('item_name', '部屋詳細の名前:') !!}
                    {!! Form::text('item_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('remaining_amount', '物品数:') !!}
                    {!! Form::number('remaining_amount', null, ['class' => 'form-control', 'placeholder' => '例：1', 'min' => 0]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('alert_amount', '警告する残量:') !!}
                    {!! Form::number('alert_amount', null, ['class' => 'form-control', 'placeholder' => '例：1', 'min' => 0]) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection