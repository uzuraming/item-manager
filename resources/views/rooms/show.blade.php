@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} の場所一覧</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $room->id }}</td>
        </tr>
        <tr>
            <th>部屋</th>
            <td>{{ $room->room_name }}</td>
        </tr>
    </table>
    
    @if (count($places) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>部屋</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($places as $place)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('places.show', $place->id, ['id' => $room->id, 'place_id' => $place->id]) !!}</td>
                    <td>{{ $place->place_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {!! link_to_route('places.create', '部屋の新規作成', ['id' => $room->id], ['class' => 'btn btn-success']) !!}
    
    {{-- 部屋編集ページへのリンク --}}
    {!! link_to_route('rooms.edit', 'この部屋を編集', ['room' => $room->id], ['class' => 'btn btn-light']) !!}
    
    {{-- 部屋削除フォーム --}}
    {!! Form::model($room, ['route' => ['rooms.destroy', $room->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}


@endsection