@extends('layouts.app')

@section('content')

    <h1>{{ $word }}を含む物品{{ count($serch_items) }}件</h1>
    


    @if (count($serch_items) > 0)
        <h2>物品一覧</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                   <th>id</th> 
                    <th>物品</th>
                    <th>残量</th>
                    <th>状態</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serch_items as $serch_item)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('items.show', $serch_item->id, ['id' => $serch_item->room_id, 'place_id' => $serch_item->place_id, 'place_detail_id' => $serch_item->place_detail_id, 'item_id' => $serch_item->id]) !!}</td>
                    <td>{{ $serch_item->item_name }}</td>
                    <td>{{ $serch_item->remaining_amount }}</td>
                    <td>
                        {{-- 0が未承認、1が承認、2が拒否、3は発注済み --}}
                        @if ($serch_item->status === 0)
                            未承認
                        @elseif ($serch_item->status === 1)
                            承認
                        @elseif ($serch_item->status === 2)
                            拒否
                        @elseif ($serch_item->status === 3)
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
@endsection