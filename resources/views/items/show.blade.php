@extends('layouts.app')

@section('content')


    
        <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0 position-relative" style="width: 72rem;">

        
            @if($item->favorited == false)

                
            {!! Form::model($item, ['route' => ['items.favorite', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]],'method' => 'put']) !!}
                     {!! Form::submit('☆', ['class' => 'position-absolute btn btn-link', 'style' => 'top:2rem; right:2rem; font-size:2rem;']) !!}
                {!! Form::close() !!}
            @else
            {!! Form::model($item, ['route' => ['items.favorite', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]],'method' => 'put']) !!}
                     {!! Form::submit('★', ['class' => 'position-absolute btn btn-link', 'style' => 'top:2rem; right:2rem; font-size:2rem;']) !!}
                {!! Form::close() !!}
            @endif
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
                                    <td>{!! link_to_route('rooms.index', '部屋一覧', [], ['class' => '']) !!}>{!! link_to_route('rooms.show', $room->room_name, ['room' => $room->id], ['class' => '']) !!} >> 
                            {!! link_to_route('places.show', $place->place_name,  ['id' => $room->id, 'place_id' => $place->id], ['class' => '']) !!}>>
                            {!! link_to_route('place_details.show', $place_detail->place_detail_name, ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id], ['class' => '']) !!}</td>
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
                                
                                            {!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}
                                        @else
                                            削除されたユーザー
                                        @endif
                                    </td>
                                  </tr>
             
                                </tbody>
                              </table>

                         
                        </div>  
                        <div class="d-flex justify-content-end">
                            
                            @if(Auth::user()->admin === config('const.ADMIN'))
                                {!! link_to_route('items.edit', '編集', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'rounded-0 btn btn-secondary mr-2 px-4']) !!}
                                {{-- 場所削除フォーム --}}
                            {!! Form::model([$item], ['route' => ['items.destroy', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'rounded-0 btn btn-danger mr-2 px-4']) !!}
                            {!! Form::close() !!}
                            @endif

                            
                            
                            
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
                                    {!! Form::submit('発注解除', ['class' => 'rounded-0 btn btn-light mr-2 px-2 px-sm-4']) !!}
                                {!! Form::close() !!}
                                
                                
                            @endif
                          
                            
                            {!! link_to_route('items.spending', '数の変更', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'rounded-0 btn btn-primary mr-2 px-2 px-sm-4']) !!}
                            
                             {!! link_to_route('items.user_history', '使用履歴', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'rounded-0 btn btn-success mr-2 px-2 px-sm-4']) !!}

                            
                        </div>

                      </div>
                </div>
               
            </div>
          </div>
        

    </div>
@endsection