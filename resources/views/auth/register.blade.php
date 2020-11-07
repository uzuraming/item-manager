@extends('layouts.app')

@section('content')


    
    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center">ユーザー登録</h2>
                {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'ユーザ名') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control' ,'placeholder' => 'ユーザー名']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'メールアドレス']) !!}
                </div>
                
                <div class="form-group">
                    <label>{!! Form::radio('admin', 0, true) !!}管理者</label>
                    <label>{!! Form::radio('admin', 1,) !!}一般ユーザー</label>
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control',  'placeholder' => 'パスワード']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control' ,'placeholder' => 'パスワード確認']) !!}
                </div>
                
                <div class="d-flex justify-content-end">
                    {!! Form::submit('登録', ['class' => 'rounded-0 btn btn-success mr-2 px-4']) !!}
                </div>

            {!! Form::close() !!}
            </div>
          </div>
        

    </div>
@endsection