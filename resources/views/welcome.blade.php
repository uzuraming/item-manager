@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <h1>{{ Auth::user()->name }}のメニュー</h1>
        
        {!! link_to_route('rooms.index', '部屋一覧', [],   ['class' => 'btn btn-success']) !!}
        
        <a class="btn btn-danger" href="{{ route('alerts.index', []) }}"> 残量僅かな物品<span class="badge badge-light">{{ $alert_number }}</span></a>
        
        <a class="btn btn-primary" href="{{ route('item_requests.index', []) }}"> 物品追加リクエスト<span class="badge badge-light">{{ $not_permission_items_number }}</span></a>
        
        {!! link_to_route('users.index', 'ユーザー一覧', [],   ['class' => 'btn btn-secondary']) !!}
        
    @endif
@endsection