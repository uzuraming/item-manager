@extends('layouts.app')

@section('content')


    
        <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <h2 class="text-center">{{ $item->item_name }}</h2>
                <div class="mt-5">
                    <div class="list-group">
 
                        <div class="row">
                            <table class="table">
                                <tbody>
                                  <tr>
                                    <th scope="row">物品名前</th>
                                    <td>{{ $item->item_name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">場所</th>
                                    <td>{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">残量</th>
                                    <td>{{ $item->remaining_amount }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">警告する残量</th>
                                    <td>{{ $item->alert_amount }}</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">作成者</th>
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

                         
                        </div>  
                        <div class="d-flex justify-content-end">

                            {!! link_to_route('items.spending', '数の変更', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'rounded-0 btn btn-primary mr-2 px-4']) !!}
                            {!! link_to_route('items.edit', '編集', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'rounded-0 btn btn-secondary mr-2 px-4']) !!}

                            
                            
                        </div>
                        <div class="d-flex justify-content-end mt-2">

                            @if($item->status != 3)
                                {{-- 発注済みにするボタン --}}
                                
                                {!! Form::model($item, ['route' => ['items.order_update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]],'method' => 'put']) !!}
                                    {!! Form::submit('発注', ['class' => 'rounded-0 btn btn-warning mr-2 px-4']) !!}
                                {!! Form::close() !!}
                            @else
                                {{-- 発注にするボタン --}}
                                {!! Form::model($item, ['route' => ['items.order_update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]],'method' => 'put']) !!}
                                    {!! Form::submit('発注解除', ['class' => 'rounded-0 btn btn-light mr-2 px-4']) !!}
                                {!! Form::close() !!}
                                
                                
                            @endif
                          
                            {{-- 場所削除フォーム --}}
                            {!! Form::model([$item], ['route' => ['items.destroy', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'rounded-0 btn btn-danger mr-2 px-4']) !!}
                            {!! Form::close() !!}
                            
                            
                        </div>

                      </div>
                </div>
               
            </div>
          </div>
        

    </div>
@endsection