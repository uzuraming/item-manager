@extends('layouts.app')

@section('content')
    {{-- ユーザ一覧 --}}
    @include('users.users')
    

        @if(Auth::user()->admin === 0)
    <div class="d-flex justify-content-end">

        
        {{-- ユーザー新規追加へのリンク --}}
    {!! link_to_route('signup.get','ユーザー作成', [], ['class' => 'rounded-0 btn btn-success mr-2 px-4']) !!}
    </div>
    @endif
@endsection