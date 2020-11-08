@extends('layouts.app')

@section('content')
    @if (Auth::check())

        
        <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center">メニュー</h2>
                <div class="mt-3 mt-sm-5">
                    {!! link_to_route('rooms.index', '部屋一覧', [],   ['class' => 'btn btn-secondary btn-block p-sm-3 py-2 mb-3 rounded-0']) !!}
                    {!! link_to_route('serch.serch', '検索', [],   ['class' => 'btn btn-success btn-block py-2 p-sm-3 mb-2 rounded-0']) !!}
        
                    <a class="btn btn-danger btn-block py-2 p-sm-3 mb-3 rounded-0" href="{{ route('alerts.index', []) }}"> 残量僅かな物品<span class="badge badge-light">{{ $alert_number }}</span></a>
                    
                    <a class="btn btn-primary btn-block py-2 p-sm-3 mb-3 rounded-0" href="{{ route('item_requests.index', []) }}"> 物品追加リクエスト<span class="badge badge-light">{{ $not_permission_items_number }}</span></a>
                    
                    {!! link_to_route('users.index', 'ユーザー一覧', [],   ['class' => 'btn btn-light btn-block py-2 p-sm-3 mb-3 rounded-0']) !!}
                </div>
               
            </div>
          </div>
         </div>
    @endif
    
    
@endsection