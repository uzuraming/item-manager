@extends('layouts.app')

@section('content')

    <h1>物品追加リクエスト</h1>


        <h2>物品</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>物品名前</th>
                    <th>残量</th>
                    <th>警告する残量</th>
                    <th>作成者</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $not_permission_item->id }}</td>
                    <td>{{ $not_permission_item->item_name }}</td>
                    <td>{{ $not_permission_item->remaining_amount }}</td>
                    <td>{{ $not_permission_item->alert_amount }}</td>
                    <td>{{ $user->name }}</td>

                </tr>
            </tbody>
        </table>

         {!! Form::model([$not_permission_item], ['route' => ['item_requests.permission', ['item_id' => $not_permission_item->id]], 'method' => 'put']) !!}
            
            <div class="form-group">
                <label>{!! Form::radio('status', 1, true) !!}承認</label>
                <label>{!! Form::radio('status', 2,) !!}拒否</label>
            </div>

            {!! Form::submit('適用', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}



@endsection