@extends('layouts.app')

@section('content')


    
    
    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <h2 class="text-center">{{ $word }}を含む物品{{ count($serch_items) }}個</h2>
                <div class="mt-5">
                    @if (count($serch_items) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>物品名</th>
                                <th>残量</th>
                                <th>状態</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($serch_items as $serch_item)
                            <tr>
                                {{-- 部屋詳細ページへのリンク --}}
                                <td>{!! link_to_route('items.show', $serch_item->item_name, ['id' => $serch_item->room_id, 'place_id' => $serch_item->place_id, 'place_detail_id' => $serch_item->place_detail_id, 'item_id' => $serch_item->id]) !!}</td>
                                <td>{{ $serch_item->remaining_amount }}</td>
                                <td>
                                    {{-- 0が未承認、1が承認、2が拒否、3は発注済み --}}
                                    @if ($serch_item->status === config('const.NOT_PERMISSION'))
                                        未承認
                                    @elseif ($serch_item->status === config('const.PERMISSION'))
                                        承認
                                    @elseif ($serch_item->status === config('const.REFUSED'))
                                        拒否
                                    @elseif ($serch_item->status === config('const.ORDERD'))
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
                </div>
                
                <div class=" d-flex justify-content-center">
               {{-- ページネーションのリンク --}}
                {{ $serch_items->links() }}
                
                </div>
            </div>
          </div>
        

    </div>
@endsection