@extends('layouts.app')

@section('content')

    
    
    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <div class="mt-5 row">
                    <div class="col-sm-6">
                        <h3>ユーザー情報</h3>
                        <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">ユーザー名</th>
                                    <td>{{ $user->name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">メールアドレス</th>
                                    <td>{{ $user->email }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">備考</th>
                                    <td>@if($user->admin == 0)
                                            管理者
                                        @else
                                            一般ユーザー
                                        @endif
                                    </td>
                                  </tr>
                                  
                                  </tr>
             
                                </tbody>
                              </table>
                          
                    @if(Auth::user()->admin === config('const.ADMIN'))
                    
                    <div class="d-flex justify-content-end">
                        {{-- 削除ボタンの実装 --}}
                    
            
                        {!! Form::model([$user], ['route' => ['users.destroy', ['user' => $user->id]], 'method' => 'delete']) !!}
                            {!! Form::submit('ユーザー削除', ['class' => 'rounded-0 btn px-sm-4  mr-2 px-2 btn-danger']) !!}
                        {!! Form::close() !!}
                        
                        
                    </div>
                    
                    
                @endif
                    </div>
                    
                    <div class="col-sm-6">
                        <h3>物品使用履歴</h3>
                @if(count($histories)>0)
                    <table class="table table-striped">
                    <thead>
                        <tr>
        
                            <th>物品名</th>
                            <th>物品の増減</th>
                            <th>日時</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                        <tr>
                            {{-- 部屋詳細ページへのリンク --}}
                           
                           <td>
                                @if($items->find($history->id))
                                 
                                    {!! link_to_route('items.show', $items->find($history->id)->item_name, ['id' => $items->find($history->id)->room_id, 'place_id' => $items->find($history->id)->place_id, 'place_detail_id' => $items->find($history->id)->place_detail_id, 'item_id' => $items->find($history->id)->id]) !!}
                                @else
                                    削除された物品
                                @endif
                            </td>
            
                            <td>
                                @if($history->pivot->amount > 0)
                                    +{{ $history->pivot->amount }}
                                @else
                                    {{ $history->pivot->amount }}
                                @endif
                                
                            </td>
                            <td>{{ $history->pivot->created_at }}</td>
                         
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{-- ページネーションのリンク --}}
                    {{ $histories->links() }}
                @endif
                </div>
               
            </div>
                
            </div>
                
          </div>
          
        

    </div>
@endsection