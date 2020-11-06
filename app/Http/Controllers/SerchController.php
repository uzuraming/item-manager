<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Itemモデル読み込み
use App\Item;

class SerchController extends Controller
{
    // 検索フォームを入力して受け取るやつ
    public function results(Request $request){
        
        $word = $request->word;
        $serch_items = Item::where('item_name', 'like', "%$word%")->get();
        
         // 検索結果一覧ビューでそれを表示
        return view('serch.results', [
            'word' => $word,
            'serch_items' => $serch_items,
        ]);
        
    }
}
