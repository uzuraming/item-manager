@extends('layouts.app')

@section('content')


    
    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center h3">{!! link_to_route('rooms.index', '部屋一覧', [], ['class' => '']) !!}>{{ $room->room_name }}</h2>
               
                <div class="mt-5">
                     @if (count($places) > 0)
                    <div class="list-group">
                        @foreach ($places as $place)
                 
                            {{-- 部屋詳細ページへのリンク --}}
                            {!! link_to_route('places.show', $place->place_name,  ['id' => $room->id, 'place_id' => $place->id], ['class' => 'list-group-item list-group-item-action']) !!}

                        @endforeach

                          <nav class="mt-5 d-flex justify-content-center" aria-label="...">
                            {{-- ページネーションのリンク --}}
                            {{ $places->links() }}
                          </nav>
                    @endif
                    
                    
                            @if(Auth::user()->admin === 0)
                            <div class="d-flex justify-content-end">
                                {!! link_to_route('rooms.edit', '編集', ['room' => $room->id], ['class' => 'rounded-0 btn btn-secondary mr-2 px-sm-4 px-2']) !!}
        
                                {{-- 場所削除フォーム --}}
                                {!! Form::model($room, ['route' => ['rooms.destroy', $room->id],  'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'rounded-0 btn btn-danger mr-2 px-sm-4  px-2']) !!}
                                {!! Form::close() !!}
                                
                                
                                {!! link_to_route('places.create', '新規作成', ['id' => $room->id],  ['class' => 'rounded-0 btn btn-success px-sm-4  mr-2 px-2']) !!}
                            </div>
                            
                            @endif
    
                      </div>
                </div>
               
            </div>
          </div>
        

    </div>
    


@endsection