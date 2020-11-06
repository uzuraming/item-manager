@extends('layouts.app')

@section('content')

    <h1>物品名検索</h1>

    <div class="row">
        <div class="col-6">
        
            {!! Form::open(['route' => 'serch.results', null,  'method' => 'get']) !!}
                <div class="form-group">
                    {!! Form::label('word', '名前:') !!}
                    {!! Form::text('word', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('検索', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection