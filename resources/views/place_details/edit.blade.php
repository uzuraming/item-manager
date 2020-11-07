@extends('layouts.app')

@section('content')


    
     <div class="mt-5 p-3 d-flex justify-content-center">
    <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
        <div class="card-body border-0">
            <h2 class="text-center">{{ $room->room_name }} >> {{ $place->place_name }}場所詳細編集</h2>
            <div class="mt-5">
                <div class="list-group">

            

                    {!! Form::model([$place_detail], ['route' => ['place_details.update', ['id' => $room->id, 'place_id' => $place->id, 'place_detail_id' => $place_detail->id]], 'method' => 'put']) !!}


                        <div class="form-group">
                                    
                            {!! Form::label('place_detail_name', '場所詳細の名前:') !!}
                            {!! Form::text('place_detail_name', $place_detail->place_detail_name, ['class' => 'form-control', 'placeholder' => '場所詳細名']) !!}
                            
                  
                            
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