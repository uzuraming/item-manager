

@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}物品数変更ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model([$item], ['route' => ['items.spending_update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]], 'method' => 'put']) !!}


                <div class="form-group">
                    {!! Form::label('remaining_amount', '物品数:') !!}
                    {!! Form::number('remaining_amount', $item->remaining_amount, ['class' => 'form-control', 'placeholder' => '例：1', 'min' => 0]) !!}
                </div>

                {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection