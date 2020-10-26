@extends('layouts.app')

@section('content')
    <div class="row">
        <div>
            <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <h3 class="card-title">{{ $user->email }}</h3>
                    @if($user->admin == 0)
                        <h3 class="card-title">管理者</h3>
                    @endif
                </div>
            <ul class="nav nav-tabs nav-justified mb-3">
                {{-- ユーザ詳細タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">物品使用履歴</a></li>
                {{-- フォロー一覧タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">物品リクエスト履歴</a></li>
                @if($user->admin == 0)
                    <li class="nav-item"><a href="#" class="nav-link">物品リクエスト履歴</a></li>
                @endif
            </ul>
        </div>
    </div>
@endsection