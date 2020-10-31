@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }}</h1>


    
    @if (count($place_details) > 0)
        <h2>場所詳細一覧</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>場所詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($place_details as $place_detail)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('place_details.show', $place_detail->id, ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]) !!}</td>
                    <td>{{ $place_detail->place_detail_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {!! link_to_route('place_details.create', '場所詳細の新規作成', ['id' => $room->id, 'place_id' => $place->id ], ['class' => 'btn btn-success']) !!}
    
    {!! link_to_route('places.edit', 'この場所の編集', ['id' => $room->id, 'place_id' => $place->id], ['class' => 'btn btn-success']) !!}
    
    {{-- 場所削除フォーム --}}
    {!! Form::model([$room, $place], ['route' => ['places.destroy', ['id' => $room->id, 'place_id' => $place->id]], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection