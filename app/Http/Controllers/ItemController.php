<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;
use App\Room; // 部屋モデル読み込み
use App\Place; // 場所モデル読み込み
use App\PlaceDetail; // 場所詳細モデル読み込み
use App\Item; // 物品モデル読み込み
use Auth; // ログインユーザー
use App\User; // ユーザーモデル読み込み

class ItemController extends Controller
{
    
    public function show($id, $place_id, $place_detail_id, $item_id)
    {
        // idの値で部屋を検索して取得
        $item = Item::findOrFail($item_id);
        $place_detail = $item->place_detail()->findOrFail($place_detail_id);
        $room = $place_detail->room()->findOrFail($id);
        $place = $place_detail->place()->findOrFail($place_id);
        
        $user = User::find($item->user_id);
        
        // 承認されていない（$item->statusが1ではない）かつ、管理者ユーザーでなければもとのURLに戻す。
        if($item->status == config('const.NOT_PERMISSION') && $item->status == config('const.ORDERD') && Auth::user()->admin != config('const.ADMIN')){
            return back();
        }else{
             // 部屋詳細ビューでそれを表示
        return view('items.show', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
            'item' => $item,
            'user' => $user,
        ]);
        }
        
        
        
       
    }
    
    public function create($id, $place_id, $place_detail_id)
    {  
        $place_detail = PlaceDetail::findOrFail($place_detail_id);
        $room = $place_detail->room()->findOrFail($id);
        $place = $place_detail->place()->findOrFail($place_id);
        $item = new item;

        // 場所作成ビューを表示
        return view('items.create', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
            'item' => $item,
        ]);
    }
    
    public function store(Request $request, $id, $place_id, $place_detail_id)
    {
        // バリデーション
        $request->validate([
            'item_name' => 'required|max:255',
            'remaining_amount' => 'required|integer|min:0',
            'alert_amount' => 'required|integer|min:0',
        ]);

        $place_detail = PlaceDetail::findOrFail($place_detail_id);
        $room = $place_detail->room()->findOrFail($id);
        $place = $place_detail->place()->findOrFail($place_id);
        
        $item = new item;
        
        $item->room_id = $room->id;
        $item->place_id = $place->id;
        $item->place_detail_id = $place_detail->id;
        $item->item_name = $request->item_name;
        $item->remaining_amount = $request->remaining_amount; // 残量
        $item->alert_amount = $request->alert_amount; // 警告する残量
        // 作成したユーザーidを登録
        $item->user_id = Auth::user()->id;
        
        
        // 管理ユーザーかどうかで、statusを振り分ける
        if(Auth::user()->admin == config('const.ADMIN')){
            // 管理ユーザーの場合
            $item->status = config('const.PERMISSION');
        }else{
            // 一般ユーザーの場合
            $item->status = config('const.NOT_PERMISSION');
        }
        
        $item->save();

        return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }
    
    public function edit($id, $place_id, $place_detail_id, $item_id)
    {
        
        
        if(Auth::user()->admin === config('const.ADMIN')){
   
            $item = Item::findOrFail($item_id);
            
            // idの値で場所詳細を検索して取得
            $place_detail = $item->place_detail()->findOrFail($place_detail_id);
            $room = $item->room()->findOrFail($id);
            $place = $item->place()->findOrFail($place_id);
    
            return view('items.edit', [
                'room' => $room,
                'place' => $place,
                'place_detail' => $place_detail,
                'item' => $item,
            ]);
        }else{
            return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
        }
    }
    public function update(Request $request, $id, $place_id, $place_detail_id, $item_id)
    {
        // バリデーション
        $request->validate([
            'item_name' => 'required|max:255',
            'remaining_amount' => 'required|integer|min:0',
            'alert_amount' => 'required|integer|min:0',
        ]);
        
        if(Auth::user()->admin === config('const.ADMIN')){
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            $item->item_name = $request->item_name;
            $item->remaining_amount = $request->remaining_amount; // 残量
            $item->alert_amount = $request->alert_amount; // 警告する残量
            // 作成したユーザーidを登録
            $item->user_id = Auth::user()->id;
            
            
            // 管理ユーザーかどうかで、statusを振り分ける
            // 0が未承認、1が承認、2が拒否、3は発注済み
            if(Auth::user()->admin == config('const.ADMIN')){
                // 管理ユーザーの場合
                $item->status = config('const.PERMISSION');
            }else{
                // 一般ユーザーの場合
                $item->status = config('const.NOT_PERMISSION');
            }
            $item->save();
        }    
        
        
        
        return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }

    public function destroy($id, $place_id, $place_detail_id, $item_id)
    {
        if(Auth::user()->admin === config('const.ADMIN')){
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            $item->delete();
        }
        return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }
    
    
    // 物品消費画面を更新する関数
    public function spending($id, $place_id, $place_detail_id, $item_id)
    {

        $item = Item::findOrFail($item_id);
        
        // idの値で場所詳細を検索して取得
        $place_detail = $item->place_detail()->findOrFail($place_detail_id);
        $room = $item->room()->findOrFail($id);
        $place = $item->place()->findOrFail($place_id);

        return view('items.spending', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
            'item' => $item,
            
        ]);
        
    }
    
    // 物品消費の処理の関数
    
    public function spending_update(Request $request, $id, $place_id, $place_detail_id, $item_id)
    {
   
            // バリデーション
            $request->validate([
                'remaining_amount' => 'required|integer|min:0',
            ]);
            
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            $item->item_name = $item->item_name;
            $before_amount = $item->remaining_amount; // 後の計算用に元あった数を取っておく
            $item->remaining_amount = $request->remaining_amount; // 残量
            $item->alert_amount = $item->alert_amount; // 警告する残量
            // 作成したユーザーidを登録
            $item->user_id = $item->user_id;
            $item->status = $item->status;
            

            // -----------------------------------
            // 以下、履歴テーブルに書き込む処理
            // -----------------------------------
            
            // ログインユーザーを定義
            $user = Auth::user();
            // 物品の増減を計算する
            $amount = $request->remaining_amount - $before_amount;
            // トランザクション処理
            
            $result = DB::transaction(function() use ($request, $id, $place_id, $place_detail_id, $item_id, $item, $user, $amount) {
                $item->save();
                
                 // // 物品の増減を記録
                $user->item_history()->attach($item->id, ['amount' => $amount]);
                
                
                return true;
            });
       
          
        
            return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id.'/'.$item_id);
    }
    
    
    // 物品の履歴を示すページの関数を作る
    public function user_history($id, $place_id, $place_detail_id, $item_id)
    {
        
        
        $item = Item::findOrFail($item_id);
        // idの値で場所詳細を検索して取得
        $place_detail = $item->place_detail()->findOrFail($place_detail_id);

        $room = $place_detail->room()->findOrFail($id);
        
        $place = $place_detail->place()->findOrFail($place_id);

        $users = User::all();
        
        // 使用履歴を中間テーブルから取得
        $histories = $item->user_history()->orderBy('created_at', 'desc')->paginate(5);
        
        // 部屋詳細ビューでそれを表示
        return view('items.user_history', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
            'item' => $item,
            'users' => $users,
            'histories' => $histories,
        ]);
    }
    
    // 発注中、発注解除をする処理
    // 物品消費の処理の関数
    
    public function order_update(Request $request, $id, $place_id, $place_detail_id, $item_id)
    {
   
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            
            if($item->status == config('const.NOT_PERMISSION') || $item->status == config('const.REFUSED')){
                return \App::abort(404);
            }else{
                $item->item_name = $item->item_name;
                $item->remaining_amount = $item->remaining_amount; // 残量
                $item->alert_amount = $item->alert_amount; // 警告する残量
                // 作成したユーザーidを登録
                $item->user_id = $item->user_id;
                
                // 発注済みの場合
                if($item->status == config('const.ORDERD')){
                    $item->status = config('const.PERMISSION');
                }else{
                    $item->status = config('const.ORDERD');
                }
    
                $item->save();
                
            
                return back();
            }
            
            
    }

    public function favorite(Request $request, $id, $place_id, $place_detail_id, $item_id)
    {
   
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            
            if($item->status == config('const.NOT_PERMISSION') || $item->status == config('const.REFUSED')){
                return \App::abort(404);
            }else{
                $item->item_name = $item->item_name;
                $item->remaining_amount = $item->remaining_amount; // 残量
                $item->alert_amount = $item->alert_amount; // 警告する残量
                // 作成したユーザーidを登録
                $item->user_id = $item->user_id;
                
                // 発注済みの場合
                if($item->favorited == false){
                    $item->favorited = true;
                }else{
                    $item->favorited = false;
                }
    
                $item->save();
                
            
                return back();
            }
            
            
    }

    
}
