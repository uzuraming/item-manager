
@extends('layouts.app')

@section('content')


    
    
    
            
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <h2 class="text-center">ブックマークされている物品{{ $item_number }}個</h2>
                <div class="mt-5">
                  @if (count($items) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>物品</th>
                                <th>残量</th>
                                <th>警告する残量</th>
                                <th>状態</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                {{-- 部屋詳細ページへのリンク --}}
                                <td>{!! link_to_route('items.show', $item->item_name, ['id' => $item->room_id, 'place_id' => $item->place_id, 'place_detail_id' => $item->place_detail_id, 'item_id' => $item->id]) !!}</td>
                              
                                <td>{{ $item->remaining_amount }}</td>
                                <td>{{ $item->alert_amount }}</td>
                                <td>
                                    {{-- 0が未承認、1が承認、2が拒否、3は発注済み --}}
                                    @if ($item->status === 3)
                                        <p class="text-success">発注済み</p>
                                    @else
                                        <p class="text-danger">未発注</p>
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
                {{ $items->links() }}
                
                </div>
            </div>
          </div>
        

    </div>
@endsection