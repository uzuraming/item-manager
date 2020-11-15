@extends('layouts.app')

@section('content')

             <div class="mt-5 p-3 d-flex justify-content-center">
        <div class="card rounded-0 shadow-sm border-0" style="width: 72rem;">
            <div class="card-body border-0">
                <h2 class="text-center">物品追加リクエスト詳細</h2>
                <div class="mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                       
                            <th>物品名前</th>
                            <th>残量</th>
                            <th>警告する残量</th>
                            <th>作成者</th>
                            <th>状態</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                    
                            <td>{!! link_to_route('items.show', $not_permission_item->item_name, ['id' => $not_permission_item->room_id, 'place_id' => $not_permission_item->place_id, 'place_detail_id' => $not_permission_item->place_detail_id, 'item_id' => $not_permission_item->id]) !!}</td>
                            <td>{{ $not_permission_item->remaining_amount }}</td>
                            <td>{{ $not_permission_item->alert_amount }}</td>
                            <td>{!! link_to_route('users.show', App\User::find($not_permission_item->user_id)->name, ['user' => App\User::find($not_permission_item->user_id)->id]) !!}</td>
                            <th>
                                @if($not_permission_item->status == config('const.NOT_PERMISSION'))
                                    <p class="text-secondary">未承認</p>
                                @elseif($not_permission_item->status ==config('const.REFUSED'))
                                    <p class="text-danger">拒否</p>
                                @endif
                            </th>
                        </tr>
                    </tbody>
                </table>
               
            </div>
            
            <div class="d-flex justify-content-center">
            @if(Auth::user()->admin == config('const.ADMIN'))
             {!! Form::model([$not_permission_item], ['route' => ['item_requests.permission', ['item_id' => $not_permission_item->id]], 'method' => 'put']) !!}
                
                <div class="form-group">
                    <label>{!! Form::radio('status', 1, true) !!}承認</label>
                    <label>{!! Form::radio('status', 2,) !!}拒否</label>
                </div>
    
                {!! Form::submit('適用', ['class' => 'rounded-0 btn btn-success mr-2 px-4']) !!}
            {!! Form::close() !!}
            @endif
            </div>
          </div>
        

    </div>
        
        
        
        




@endsection