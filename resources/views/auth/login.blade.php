@extends('layouts.app')

@section('content')

    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center">ログイン</h2>
                {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'メールアドレス']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'パスワード']) !!}
                </div>
                
                <div class="d-flex justify-content-end">
                    {!! Form::submit('ログイン', ['class' => 'rounded-0 btn btn-success mr-2 px-4']) !!}
                </div>
            {!! Form::close() !!}
            </div>
          </div>
        

    </div>

@endsection