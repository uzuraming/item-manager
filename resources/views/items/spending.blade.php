

@extends('layouts.app')

@section('content')

    
      <div class="mt-5 p-3 d-flex justify-content-center">
    <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
        <div class="card-body border-0">
            <h2 class="text-center">{{ $room->room_name }} >> {{ $place->place_name }} >> {{ $place_detail->place_detail_name }} >> {{ $item->item_name }}の物品数変更</h2>
            <div class="mt-5">
                <div class="list-group">

            

                     {!! Form::model([$item], ['route' => ['items.spending_update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id, 'item_id' => $item->id]], 'method' => 'put']) !!}

                        <div class="form-group">
                                    
                            
                            {!! Form::label('remaining_amount', '物品数:') !!}
                            {!! Form::number('remaining_amount', $item->remaining_amount, ['class' => 'form-control', 'placeholder' => '例：1', 'min' => 0]) !!}
                          
                            
                            <div class="d-flex justify-content-end mt-2">
                                   {!! Form::submit('作成', ['class' => 'rounded-0 btn btn-success mr-2 px-4',]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
            
                        
                    </div>  
                    
            </div>
           
        </div>
      </div>
@endsection