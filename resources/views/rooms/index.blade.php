@extends('layouts.app')

@section('content')
    {{-- 部屋一覧 --}}

    
    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center">部屋一覧</h2>
                <div class="mt-5">
                    @if (count($rooms) > 0)
                    <div class="list-group">
                        @foreach ($rooms as $room)
                 
                            {{-- 部屋詳細ページへのリンク --}}
                            {!! link_to_route('rooms.show', $room->room_name, ['room' => $room->id], ['class' => 'list-group-item list-group-item-action']) !!}
                  
                        @endforeach

                          <nav class="mt-5 d-flex justify-content-center" aria-label="...">
                            {{-- ページネーションのリンク --}}
                            {{ $rooms->links() }}
                          </nav>
    @endif

                            @if(Auth::user()->admin === 0)
                            <div class="d-flex justify-content-end">
                                {!! link_to_route('rooms.create', '部屋の新規作成', [], ['class' => 'rounded-0 btn btn-success mr-2 px-4']) !!}
                            </div>
                            @endif
    
                      </div>
                </div>
               
            </div>
          </div>
        

    </div>

@endsection