@extends('layouts.app')

@section('content')


    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center">{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }}</h2>
                <div class="mt-5">
                    @if (count($items) > 0)
                    <div class="list-group">
                        @foreach ($items as $item)
                 
                            {{-- 部屋詳細ページへのリンク --}}
                          
                            {!! link_to_route('items.show', $item->item_name, ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id], ['class' => 'list-group-item list-group-item-action'])  !!}
                        @endforeach

                          <nav class="mt-5 d-flex justify-content-center" aria-label="...">
                            {{-- ページネーションのリンク --}}
                            {{ $items->links() }}
                          </nav>
                    @endif

                           
                            <div class="d-flex justify-content-end">
                                 @if(Auth::user()->admin === 0)
                                {!! link_to_route('place_details.edit', '編集', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id],['class' => 'rounded-0 btn btn-secondary mr-2 px-sm-4 px-2']) !!}
        
                                {{-- 場所削除フォーム --}}
                                {!! Form::model([$place_detail], ['route' => ['place_details.destroy', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'rounded-0 btn btn-danger mr-2 px-sm-4 px-2']) !!}
                                {!! Form::close() !!}
                                 @endif
                               {!! link_to_route('items.create', '新規作成', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id ], ['class' => 'rounded-0 btn btn-success mr-2 px-sm-4 px-2']) !!}
    
                            </div>
                            
                           
                             
                      </div>
                </div>
               
            </div>
          </div>
        

    </div>
@endsection