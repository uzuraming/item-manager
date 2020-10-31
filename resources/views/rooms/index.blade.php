@extends('layouts.app')

@section('content')
    {{-- 部屋一覧 --}}
    <h1>部屋一覧</h1>

    @if (count($rooms) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>部屋</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('rooms.show', $room->id, ['room' => $room->id]) !!}</td>
                    <td>{{ $room->room_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {!! link_to_route('rooms.create', '部屋の新規作成', [], ['class' => 'btn btn-success']) !!}
@endsection