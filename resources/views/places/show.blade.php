@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }}</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $place->id }}</td>
        </tr>
        <tr>
            <th>場所</th>
            <td>{{ $place->place_name }}</td>
        </tr>
    </table>
    
    {!! link_to_route('places.edit', 'この場所の編集', ['id' => $room->id, 'place_id' => $place->id], ['class' => 'btn btn-success']) !!}
    
    {{-- 場所削除フォーム --}}
    {!! Form::model([$room, $place], ['route' => ['places.destroy', ['id' => $room->id, 'place_id' => $place->id]], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection