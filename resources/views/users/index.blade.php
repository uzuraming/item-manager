@extends('layouts.app')

@section('content')
    {{-- ユーザ一覧 --}}
    @include('users.users')
    
    {{-- ユーザー新規追加へのリンク --}}
    {!! link_to_route('signup.get','ユーザー作成', [], ['class' => 'btn btn-success']) !!}
@endsection