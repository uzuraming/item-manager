@extends('layouts.app')

@section('content')

    <h1>残量僅かな物品{{ $alert_number }}個</h1>
    


    @if (count($items) > 0)
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
                @foreach ($items as $item)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('items.show', $item->id, ['id' => $item->room_id, 'place_id' => $item->place_id, 'place_detail_id' => $item->place_detail_id, 'item_id' => $item->id]) !!}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->remaining_amount }}</td>
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
@endsection