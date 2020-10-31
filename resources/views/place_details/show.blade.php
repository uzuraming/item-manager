@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $place_detail->id }}</td>
        </tr>
        <tr>
            <th>場所詳細</th>
            <td>{{ $place_detail->place_detail_name }}</td>
        </tr>
    </table>
    

    {!! link_to_route('place_details.edit', 'この場所詳細の編集', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id], ['class' => 'btn btn-success']) !!}
    
    {{-- 場所削除フォーム --}}
    {!! Form::model([$place_detail], ['route' => ['place_details.destroy', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection