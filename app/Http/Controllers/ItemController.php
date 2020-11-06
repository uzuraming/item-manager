<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room; // 追加

use App\Place; // 追加

use App\PlaceDetail; // 追加

use App\Item; // 追加

use Auth; // ログインユーザー

use App\User; // ユーザー

class ItemController extends Controller
{
    
    public function show($id, $place_id, $place_detail_id, $item_id)
    {
        
        
        $item = Item::findOrFail($item_id);
        // idの値で場所詳細を検索して取得
        $place_detail = $item->place_detail()->findOrFail($place_detail_id);
        
        // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
        // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
        $room = $place_detail->room()->findOrFail($id);
        
        // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
        // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
        $place = $place_detail->place()->findOrFail($place_id);
        
        // // idの値で部屋を検索して取得
        // $room = Room::findOrFail($id);
        // // idの値で場所を検索して取得
        // $place = Place::findOrFail($place_id);
        
        $user = User::find($item->user_id);
        
        
        // 部屋詳細ビューでそれを表示
        return view('items.show', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
            'item' => $item,
            'user' => $user,
        ]);
    }
    
    public function create($id, $place_id, $place_detail_id)
    {   
        

            // $room = Room::findOrFail($id);
            // $place = Place::findOrFail($place_id);
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

        // $room = Room::findOrFail($id);
        // $place = Place::findOrFail($place_id);
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
        // 0が未承認、1が承認、2が拒否、3は発注済み
        if(Auth::user()->admin == 0){
            // 管理ユーザーの場合
            $item->status = 1;
        }else{
            // 一般ユーザーの場合
            $item->status = 0;
        }
        
        $item->save();

        
        
        
        return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }
    
    public function edit($id, $place_id, $place_detail_id, $item_id)
    {
        if(Auth::user()->admin === 0){
            // $room = Room::findOrFail($id);
            // $place = Place::findOrFail($place_id);
            
            // $place_detail = PlaceDetail::findOrFail($place_detail_id);
            
            
            $item = Item::findOrFail($item_id);
            
            // idの値で場所詳細を検索して取得
            $place_detail = $item->place_detail()->findOrFail($place_detail_id);
            
            // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
            // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
            $room = $item->room()->findOrFail($id);
            
            // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
            // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
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
        if(Auth::user()->admin === 0){
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            $item->item_name = $request->item_name;
            $item->remaining_amount = $request->remaining_amount; // 残量
            $item->alert_amount = $request->alert_amount; // 警告する残量
            // 作成したユーザーidを登録
            $item->user_id = Auth::user()->id;
            
            
            // 管理ユーザーかどうかで、statusを振り分ける
            // 0が未承認、1が承認、2が拒否、3は発注済み
            if(Auth::user()->admin == 0){
                // 管理ユーザーの場合
                $item->status = 1;
            }else{
                // 一般ユーザーの場合
                $item->status = 0;
            }
            $item->save();
        }    
        
        
        
        return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }

    public function destroy($id, $place_id, $place_detail_id)
    {
        if(Auth::user()->admin === 0){
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            $item->delete();
        }
        return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }
    
    
    // 物品消費画面を表示する関数
    public function spending($id, $place_id, $place_detail_id, $item_id)
    {
       
        // $room = Room::findOrFail($id);
        // $place = Place::findOrFail($place_id);
        
        // $place_detail = PlaceDetail::findOrFail($place_detail_id);
        
        
        $item = Item::findOrFail($item_id);
        
        // idの値で場所詳細を検索して取得
        $place_detail = $item->place_detail()->findOrFail($place_detail_id);
        
        // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
        // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
        $room = $item->room()->findOrFail($id);
        
        // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
        // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
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
   
            $item = Item::where('room_id', $id)->where('place_id', $place_id)->where('place_detail_id', $place_detail_id)->findOrFail($item_id);
            $item->item_name = $item->item_name;
            $item->remaining_amount = $request->remaining_amount; // 残量
            $item->alert_amount = $item->alert_amount; // 警告する残量
            // 作成したユーザーidを登録
            $item->user_id = Auth::user()->id;
            
            
            // 管理ユーザーかどうかで、statusを振り分ける
            // 0が未承認、1が承認、2が拒否、3は発注済み
            if(Auth::user()->admin == 0){
                // 管理ユーザーの場合
                $item->status = 1;
            }else{
                // 一般ユーザーの場合
                $item->status = 0;
            }
            $item->save();
          
        
        
            return redirect('/rooms/'.$id.'/'.$place_id.'/'.$place_detail_id);
    }
    
    
    
}