<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room; // 追加

use App\Place; // 追加

use App\PlaceDetail; // 追加

class PlaceDetailsController extends Controller
{
    public function show($id, $place_id, $place_detail_id)
    {
        // idの値で部屋を検索して取得
        $room = Room::findOrFail($id);
        // idの値で場所を検索して取得
        $place = Place::findOrFail($place_id);
        // idの値で場所詳細を検索して取得
        $place_detail = PlaceDetail::findOrFail($place_detail_id);
        
        

        // 部屋詳細ビューでそれを表示
        return view('place_details.show', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail
        ]);
    }
    
    public function create($id, $place_id)
    {   
        $room = Room::findOrFail($id);
        $place = Place::findOrFail($place_id);
        
        $place_detail = new PlaceDetail;

        // 場所作成ビューを表示
        return view('place_details.create', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail,
        ]);
        
        
    }
    
    public function store(Request $request, $id, $place_id)
    {
        $room = Room::findOrFail($id);
        $place = Place::findOrFail($place_id);
        $place_detail = new PlaceDetail;
        
        $place_detail->room_id = $room->id;
        $place_detail->place_id = $place->id;
        $place_detail->place_detail_name = $request->place_detail_name;
        
        $place_detail->save();
        
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }
    
    public function edit($id, $place_id, $place_detail_id)
    {
        $room = Room::findOrFail($id);
        $place = Place::findOrFail($place_id);
        
        $place_detail = PlaceDetail::findOrFail($place_detail_id);

        return view('place_details.edit', [
            'room' => $room,
            'place' => $place,
            'place_detail' => $place_detail
            
        ]);
    }
    public function update(Request $request, $id, $place_id, $place_detail_id)
    {

        $place_detail = PlaceDetail::where('room_id', $id)->where('place_id', $place_id)->findOrFail($place_detail_id);
        $place_detail->place_detail_name = $request->place_detail_name;
        $place_detail->save();
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }

    public function destroy($id, $place_id, $place_detail_id)
    {
        $place_detail = PlaceDetail::where('room_id', $id)->where('place_id', $place_id)->findOrFail($place_detail_id);
        $place_detail->delete();
        return redirect('/rooms/'.$id.'/'.$place_id);
    }
}
