@extends('layouts.app')

@section('content')

    
    
        <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <h2 class="text-center">物品追加リクエスト{{ $not_permission_items_number }}個</h2>
                <div class="mt-5">
                 @if (count($not_permission_items) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>物品</th>
                                <th>残量</th>
                                <th>申請者</th>
                                <th>状態</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($not_permission_items as $not_permission_item)
                            <tr>
                                {{-- 部屋詳細ページへのリンク --}}
                                <td>{!! link_to_route('item_requests.show', $not_permission_item->item_name, ['item_id' => $not_permission_item->id]) !!}</td> 
                                <td>{{ $not_permission_item->remaining_amount }}</td>
                                <td>{!! link_to_route('users.show', App\User::find($not_permission_item->user_id)->name, ['user' => App\User::find($not_permission_item->user_id)->id]) !!}</td>
                                <th>
                                @if($not_permission_item->status == config('const.NOT_PERMISSION'))
                                    <p class="text-secondary">未承認</p>
                                @elseif($not_permission_item->status ==config('const.REFUSED'))
                                    <p class="text-danger">拒否</p>
                                @endif
                            </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                </div>
                <div class=" d-flex justify-content-center">
                    {{-- ページネーションのリンク --}}
                {{ $not_permission_items->links() }}
                </div>
               
            </div>
          </div>
        

    </div>
    
    
@endsection