<?php

namespace App\Http\Controllers;
use App\Item; // 追加

use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        // remaining_amountがalert_amount以下の物品一覧を取得
        $items = Item::whereIn('status', [config('const.PERMISSION'), config('const.ORDERD')])->whereColumn('alert_amount', '>=', 'remaining_amount')->paginate(5);
        $alert_number = count($items);

        // 部屋一覧ビューでそれを表示
        return view('alerts.index', [
            'items' => $items,
            'alert_number' => $alert_number
        ]);
    }
}
