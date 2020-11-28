<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item; // 追加

class FavoritesController extends Controller
{
    // お気に入りを表示する関数
    public function index()
    {
        // remaining_amountがalert_amount以下の物品一覧を取得
        $items = Item::whereIn('status', [config('const.PERMISSION'), config('const.ORDERD')])->where('favorited', true)->paginate(5);
        $item_number = count($items);

        // 部屋一覧ビューでそれを表示
        return view('favorites.index', [
            'items' => $items,
            'item_number' => $item_number
        ]);
    }
}
