@extends('layouts.app')

@section('content')

    <h1>id: {{ $place_detail->place_detail_name }} の名前編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model([$place_detail], ['route' => ['place_details.update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('place_detail_name', '場所詳細の名前:') !!}
                    {!! Form::text('place_detail_name', $place_detail->place_detail_name, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection