@extends('layouts.app')

@section('content')


        
        
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <h2 class="text-center">{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }} >> {{ $item->item_name }}の使用履歴</h2>
                <div class="mt-5">
                    @if (count($histories) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                
                                <th>名前</th>
                                <th>物品の増減</th>
                                <th>日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                            <tr>
                                {{-- 部屋詳細ページへのリンク --}}
                               
                               <td>
                                    @if($users->find($history->id))
                                     
                                         
                                         {!! link_to_route('users.show', $users->find($history->id)->name, ['user' => $users->find($history->id)->id]) !!}
                                    @else
                                        削除されたユーザー
                                    @endif
                                </td>
                
                                <td>
                                    @if($history->pivot->amount > 0)
                                        +{{ $history->pivot->amount }}
                                    @else
                                        {{ $history->pivot->amount }}
                                    @endif
                                    
                                    
                                    
                                </td>
                                <td>{{ $history->pivot->updated_at }}</td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                @endif
                </div>
               {{-- ページネーションのリンク --}}
        {{ $histories->links() }}
            </div>
          </div>
        

    </div>
@endsection