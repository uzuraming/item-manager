

    <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 36rem;">
            <div class="card-body border-0">
                <h2 class="text-center">ユーザー一覧</h2>
                <div class="mt-5">
                   @if (count($users) > 0)
                   @foreach ($users as $user)
                    <div class="list-group">
         
                 
                                {{-- ユーザ詳細ページへのリンク --}}
                                {!! link_to_route('users.show', $user->name, ['user' => $user->id], ['class' => 'list-group-item list-group-item-action']) !!}
                          
                    @endforeach
                    <nav class="mt-5 d-flex justify-content-center" aria-label="...">
                            {{-- ページネーションのリンク --}}
                            {{-- $rooms->links() --}}
                          </nav>
                     @endif


    
                      </div>
                </div>
               
            </div>
          </div>
        

    </div>
