<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

use App\User;


class ItemRequestController extends Controller
{
    public function index(){
        // 未承認の物品を取得
        $not_permission_items = item::where('status', 0)->get();
        $not_permission_items_number = count($not_permission_items);
        
        
        
        // リクエスト一覧ビューでそれを表示
        return view('item_requests.index', [
            'not_permission_items' => $not_permission_items,
            'not_permission_items_number' => $not_permission_items_number,
        ]);
    }
    
    public function show($item_id){
        
        $not_permission_item = Item::findOrFail($item_id);
        $user = User::findOrFail($not_permission_item->user_id);
        
        // 承認されているIdを打ち込まれた場合は404を返す
        if($not_permission_item->status !== 0){
            return \App::abort(404);
        }else{
            // リクエスト一覧ビューでそれを表示
        return view('item_requests.show', [
            'not_permission_item' => $not_permission_item,
            'user' => $user
        ]);
        }
    }
    
    public function permission(Request $request, $item_id){
        
        $not_permission_item = Item::findOrFail($item_id);
        
        $not_permission_item->item_name = $not_permission_item->item_name;
        $not_permission_item->remaining_amount = $not_permission_item->remaining_amount; // 残量
        $not_permission_item->alert_amount = $not_permission_item->alert_amount; // 警告する残量
        // 作成したユーザーidを登録
        $not_permission_item->user_id = $not_permission_item->user_id;
        // ステータスを変更
        $not_permission_item->status = $request->status;
        $not_permission_item->save();
        
        return redirect('/item_request');
    }
    
    
}
