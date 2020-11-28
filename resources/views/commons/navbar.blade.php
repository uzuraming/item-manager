<header class="mb-4">
    <nav  class="navbar navbar-expand-lg navbar-light" style="background-color: white;">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Item Manager</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                
                     <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ユーザー</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item"> {!! link_to_route('users.index', 'ユーザー一覧', [],   ['class' => '']) !!}</li>
                                <li class="dropdown-divider"></li>
                                @if(Auth::user()->admin == config('const.ADMIN'))
                                    {{-- ユーザ登録ページへのリンク --}}
                                    <li class="dropdown-item">{!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => '']) !!}</li>
                                @endif
                                
                            </ul>
                        
                    </li>
                    
                    
                    
                    
                    
        
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">物品を探す</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('rooms.index', '部屋一覧', [],   ['class' => '']) !!}</li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                    <a class="" href="{{ route('alerts.index', []) }}"> 残量僅かな物品</span></a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                    <a class="" href="{{ route('item_requests.index', []) }}"> 物品追加リクエスト</a>
                        
                                </li>
                            </ul>
                        
                    </li>
                    
                    
                    
                    
                    
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('users.show', '自分のユーザー情報', ['user' => Auth::id()]) !!}</li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                                
                            </ul>
                        
                    </li>

                    {!! Form::open(['route' => 'search.results', null,  'method' => 'get']) !!}

                        <div class="form-group form-inline">
                            {!! Form::text('word', null, ['class' => 'form-control mr-sm-2']) !!}
                            
                            
                            {!! Form::submit('検索', ['class' => 'btn btn-outline-success my-2 my-sm-0', ]) !!}
                            
                        </div>
                    {!! Form::close() !!}
                    
                @else
                    
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>