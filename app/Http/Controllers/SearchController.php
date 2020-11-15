<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Itemモデル読み込み
use App\Item;

class SearchController extends Controller
{
    // 検索フォームを入力して受け取るやつ
    public function results(Request $request){
        
        // バリデーション
        $request->validate([
            'word' => 'required|max:255',
        ]);
        
        
        $word = $request->word;
        $serch_items = Item::where('item_name', 'like', "%$word%")->paginate(5);
        
         // 検索結果一覧ビューでそれを表示
        return view('search.results', [
            'word' => $word,
            'serch_items' => $serch_items,
        ]);
        
    }
}
