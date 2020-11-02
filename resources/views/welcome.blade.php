@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <h1>{{ Auth::user()->name }}のメニュー</h1>
        
        {!! link_to_route('rooms.index', '部屋一覧', [],   ['class' => 'btn btn-success']) !!}
        
        <a class="btn btn-danger" href="{{ route('alerts.index', []) }}"> 残量僅かな物品<span class="badge badge-light">{{ $alert_number }}</span></a>
        
        <a class="btn btn-primary" href="{{ route('alerts.index', []) }}"> 物品追加リクエスト<span class="badge badge-light">{{ $alert_number }}</span></a>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
                
                
            </div>
        </div>
    @endif
@endsection