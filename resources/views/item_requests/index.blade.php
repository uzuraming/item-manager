@extends('layouts.app')

@section('content')

    <h1>物品追加リクエスト{{ $not_permission_items_number }}個</h1>
    
    @if (count($not_permission_items) > 0)
        <h2>物品一覧</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>物品</th>
                    <th>残量</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($not_permission_items as $not_permission_item)
                <tr>
                    {{-- 部屋詳細ページへのリンク --}}
                    <td>{!! link_to_route('item_requests.show', $not_permission_item->id, ['item_id' => $not_permission_item->id]) !!}</td> 
                    <td>{{ $not_permission_item->item_name }}</td>
                    <td>{{ $not_permission_item->remaining_amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    
@endsection