

@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}物品編集ページ</h1>

    <div class="row">
        <div class="col-6">
        
            {!! Form::model([$item], ['route' => ['items.update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('item_name', '部屋詳細の名前:') !!}
                    {!! Form::text('item_name', $item->item_name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('remaining_amount', '物品数:') !!}
                    {!! Form::number('remaining_amount', $item->remaining_amount, ['class' => 'form-control', 'placeholder' => '例：1', 'min' => 0]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('alert_amount', '警告する残量:') !!}
                    {!! Form::number('alert_amount', $item->alert_amount, ['class' => 'form-control', 'placeholder' => '例：1', 'min' => 0]) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection