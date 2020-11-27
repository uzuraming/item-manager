<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\Place;
use App\PlaceDetail;
use Auth; // ログインユーザー
use App\User; // ユーザー

class PlacesController extends Controller
{
    public function show($id, $place_id)
    {
        
        // idの値で部屋を検索して取得
        $place = Place::findOrFail($place_id);
        $room = $place->room()->findOrFail($id);
        
        // 全場所詳細を取得
        $place_details = $place->place_details_from_place()->where('room_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        
        
        // 部屋詳細ビューでそれを表示
        return view('places.show', [
            'room' => $room,
            'place' => $place,
            'place_details' => $place_details
        ]);
    }

    public function create($id)
    {   
        
        if(Auth::user()->admin === config('const.ADMIN')){
            $room = Room::findOrFail($id);
            $place = new Place;
    
            // 場所作成ビューを表示
            return view('places.create', [
                'room' => $room,
                'place' => $place,
            ]);
        }else{
            return redirect('/rooms/'.$id);
        }
        
        
    }

    public function store(Request $request, $id)
    {
        
        // バリデーション
        $request->validate([
            'place_name' => 'required|max:255',
        ]);
        
        if(Auth::user()->admin === config('const.ADMIN')){
            $room = Room::findOrFail($id);
            $room->places()->create(['place_name' => $request->place_name]);
        }
        return redirect('/rooms/'.$id);
    }

    public function edit($id, $place_id)
    {
        if(Auth::user()->admin === config('const.ADMIN')){
            $place = Place::findOrFail($place_id);
            $room = $place->room()->findOrFail($id);
    
            return view('places.edit', [
                'room' => $room,
                'place' => $place,
            ]);
        }else{
           return redirect('/rooms/'.$id); 
        }
        
        
    }

    public function update(Request $request, $id, $place_id)
    {
        // バリデーション
        $request->validate([
            'place_name' => 'required|max:255',
        ]);
        
        if(Auth::user()->admin === config('const.ADMIN')){
            $place = Place::where('room_id', $id)->findOrFail($place_id);
            $place->place_name = $request->place_name;
            $place->save();
        }
        
        
        return redirect('/rooms/'.$id);
    }

    public function destroy($id, $place_id)
    {
        if(Auth::user()->admin === config('const.ADMIN')){
            $place = Place::where('room_id', $id)->findOrFail($place_id);
            $place->delete();
        }
        
        return redirect('/rooms/'.$id);
    }
    
}
