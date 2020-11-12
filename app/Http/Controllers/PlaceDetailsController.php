<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room; // 追加
use App\Place; // 追加
use App\PlaceDetail; // 追加
use App\Item; // 追加
use Auth; // ログインユーザー
use App\User; // ユーザー

class PlaceDetailsController extends Controller
{
    public function show($id, $place_id, $place_detail_id)
    {
        
        // idの値で場所詳細を検索して取得
        $place_detail = PlaceDetail::findOrFail($place_detail_id);
        
        // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
        // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
        $room = $place_detail->room()->findOrFail($id);
        
        // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
        // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
        $place = $place_detail->place()->findOrFail($place_id);
        
        // 管理者ユーザーの場合、未承認も表示する
        if(Auth::user()->admin == 0){
            $items = $place_detail->item_from_place_detail()->where('room_id', $id)->where('place_id', $place_id)->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $items = $place_detail->item_from_place_detail()->where('room_id', $id)->where('place_id', $place_id)->whereNotIn('status', [0, 2])->orderBy('created_at', 'desc')->paginate(10);
        }


        // 部屋詳細ビューでそれを表示
        return view('place_details.show', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
            'items' => $items
        ]);
    }
    
    public function create($id, $place_id)
    {   
        if(Auth::user()->admin === 0){
            $place = Place::findOrFail($place_id);
            // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
            // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
            $room = $place->room()->findOrFail($id);
            
            
            $place_detail = new PlaceDetail;
    
            // 場所作成ビューを表示
            return view('place_details.create', [
                'room' => $room,
                'place' => $place,
                'place_detail' => $place_detail,
            ]);
        }else{
            return redirect('/rooms/'.$id.'/'.$place_id);
        }
        
    }
    
    public function store(Request $request, $id, $place_id)
    {
        
        // バリデーション
        $request->validate([
            'place_detail_name' => 'required|max:255',
        ]);
        
        
        if(Auth::user()->admin === 0){
            $place = Place::findOrFail($place_id);
            // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
            // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
            $room = $place->room()->findOrFail($id);
            $place_detail = new PlaceDetail;
            
            $place_detail->room_id = $room->id;
            $place_detail->place_id = $place->id;
            $place_detail->place_detail_name = $request->place_detail_name;
            
            $place_detail->save();
        }
        
        
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }
    
    public function edit($id, $place_id, $place_detail_id)
    {
        
        if(Auth::user()->admin === 0){
            // $room = Room::findOrFail($id);
            // $place = Place::findOrFail($place_id);
            
            // $place_detail = PlaceDetail::findOrFail($place_detail_id);
            // idの値で場所詳細を検索して取得
            $place_detail = PlaceDetail::findOrFail($place_detail_id);
            
            // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
            // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
            $room = $place_detail->room()->findOrFail($id);
            
            // URLのplace_Idから、database上のroomIdを取得。これがURL上のidと一致しているかを確認し、その部屋が存在するかをチェックする
            // 一致しなければ直接URLを打ち込んでいると考えられるため、404を返す。
            $place = $place_detail->place()->findOrFail($place_id);
    
            return view('place_details.edit', [
                'room' => $room,
                'place' => $place,
                'place_detail' => $place_detail
                
            ]);
            
            
        }else{
            return redirect('/rooms/'.$id.'/'.$place_id);
        }
        
    }
    public function update(Request $request, $id, $place_id, $place_detail_id)
    {
        
        // バリデーション
        $request->validate([
            'place_detail_name' => 'required|max:255',
        ]);
        
        if(Auth::user()->admin === 0){
            $place_detail = PlaceDetail::where('room_id', $id)->where('place_id', $place_id)->findOrFail($place_detail_id);
            $place_detail->place_detail_name = $request->place_detail_name;
            $place_detail->save();
        }
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }

    public function destroy($id, $place_id, $place_detail_id)
    {
        if(Auth::user()->admin === 0){
            $place_detail = PlaceDetail::where('room_id', $id)->where('place_id', $place_id)->findOrFail($place_detail_id);
            $place_detail->delete();
        }
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }
    
    function isAdmin()
    {
        return (Auth::user()->admin === 0);
    }
    
}
