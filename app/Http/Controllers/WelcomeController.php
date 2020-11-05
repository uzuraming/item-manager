<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class WelcomeController extends Controller
{
    public function index(){
        // remaining_amountがalert_amount以下の物品一覧を取得
        $items = Item::whereColumn('alert_amount', '>', 'remaining_amount')->get();
        $alert_number = count($items);
        
        // 未承認の物品を取得
        $not_permission_items = item::where('status', 0)->get();
        $not_permission_items_number = count($not_permission_items);
        

        return view('welcome', [
            'alert_number' => $alert_number,
            'not_permission_items_number' => $not_permission_items_number,
        ]);
    }
}
