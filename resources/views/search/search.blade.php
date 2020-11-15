@extends('layouts.app')

@section('content')


    
    
    
    
    
    <div class="mt-5 p-3 d-flex justify-content-center">
    <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
        <div class="card-body border-0">
            <h2 class="text-center">物品の検索</h2>
            <div class="mt-5">
                <div class="list-group">

            

         
                    {!! Form::open(['route' => 'search.results', null,  'method' => 'get']) !!}

                        <div class="form-group">
                            {!! Form::label('word', '名前:') !!}
                            {!! Form::text('word', null, ['class' => 'form-control']) !!}
                            
                            <div class="d-flex justify-content-end mt-2">
                                   {!! Form::submit('検索', ['class' => 'rounded-0 btn btn-success mr-2 px-4', ]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
            
                        
                    </div>  
                    
            </div>
           
        </div>
      </div>
@endsection