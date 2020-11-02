@extends('layouts.app')

@section('content')

    <h1>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}</h1>


    @if (count($items) > 0)
        <h2>物品一覧</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>物品</th>
                    <th>状態</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('items.show', $item->id, ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]) !!}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>
                        {{-- 0が未承認、1が承認、2が拒否、3は発注済み --}}
                        @if ($item->status === 0)
                            未承認
                        @elseif ($item->status === 1)
                            承認
                        @elseif ($item->status === 2)
                            拒否
                        @elseif ($item->status === 3)
                            発注済み
                        @else
                            その他
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    
        {!! link_to_route('items.create', '物品の新規作成', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id ], ['class' => 'btn btn-success']) !!}
        {!! link_to_route('place_details.edit', 'この場所詳細の編集', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id], ['class' => 'btn btn-success']) !!}
        
        {{-- 場所削除フォーム --}}
        {!! Form::model([$place_detail], ['route' => ['place_details.destroy', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    @if(Auth::user()->admin === 0)
    @endif
@endsection