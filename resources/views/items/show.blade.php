@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}</h1>


        <h2>物品</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>物品名前</th>
                    <th>残量</th>
                    <th>警告する残量</th>
                    <th>作成者</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->remaining_amount }}</td>
                    <td>{{ $item->alert_amount }}</td>
                    <td>
                        @if($item->user_id)
                            {{ $user->name }}
                        @else
                            削除されたユーザー
                        @endif
                    </td>

                </tr>
            </tbody>
        </table>


     {!! link_to_route('items.spending', 'この物品の数の変更', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'btn btn-primary']) !!}
    {!! link_to_route('items.edit', 'この物品の編集', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'btn btn-success']) !!}
    
    {{-- 場所削除フォーム --}}
    {!! Form::model([$item], ['route' => ['items.destroy', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]]], ['method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection