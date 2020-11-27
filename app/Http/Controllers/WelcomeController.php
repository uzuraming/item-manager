<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class WelcomeController extends Controller
{
    
    // ホーム画面の情報を取得する
    
    public function index(){
        // remaining_amountがalert_amount以下の物品数を取得
        $items = Item::whereIn('status', [config('const.PERMISSION'), config('const.ORDERD')])->whereColumn('alert_amount', '>=', 'remaining_amount')->get();
        $alert_number = count($items);
        
        // 未承認の物品数を取得
        $not_permission_items = item::where('status', config('const.NOT_PERMISSION'))->orWhere('status', config('const.REFUSED'))->get();
        $not_permission_items_number = count($not_permission_items);
        
        // view
        return view('welcome', [
            'alert_number' => $alert_number,
            'not_permission_items_number' => $not_permission_items_number,
        ]);
    }
}
