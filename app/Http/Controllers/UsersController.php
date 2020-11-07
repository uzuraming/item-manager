<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // Userを名前空間として利用

use Auth; // ログインユーザー

use App\Item;


class UsersController extends Controller
{
    // 表示
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        $items = Item::all();
        // // idの値で場所詳細を検索して取得
        // $place_detail = $item->place_detail()->findOrFail($place_detail_id);

        // $room = $place_detail->room()->findOrFail($id);
        
        // $place = $place_detail->place()->findOrFail($place_id);

        // $users = User::all();
        
        // 使用履歴を中間テーブルから取得
        $histories = $user->item_history()->orderBy('created_at', 'desc')->paginate(5);
        
        // 物品使用履歴データ

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'histories' => $histories,
            'items' => $items
        ]);
    }
    
    // user削除機能
    public function destroy($id){
        
        
        // 管理者ユーザーか判別
        if(Auth::user()->admin === 0){
            $user = User::findOrFail($id);
            $user->delete();
        }
        
        return redirect('/users');
    }
}
