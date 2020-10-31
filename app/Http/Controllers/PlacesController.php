<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\Place;
use App\PlaceDetail;

class PlacesController extends Controller
{
    public function show($id, $place_id)
    {
        // idの値で部屋を検索して取得
        $room = Room::findOrFail($id);
        // idの値で部屋を検索して取得
        $place = Place::findOrFail($place_id);
        
        // 全場所詳細を取得
        $place_details = PlaceDetail::all();
        
        

        // 部屋詳細ビューでそれを表示
        return view('places.show', [
            'room' => $room,
            'place' => $place,
            'place_details' => $place_details
        ]);
    }

    public function create($id)
    {   
        $room = Room::findOrFail($id);
        $place = new Place;

        // 場所作成ビューを表示
        return view('places.create', [
            'room' => $room,
            'place' => $place,
        ]);
        
        
    }

    public function store(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->places()->create(['place_name' => $request->place_name]);
        return redirect('/rooms/'.$id);
    }

    public function edit($id, $place_id)
    {
        $room = Room::findOrFail($id);
        $place = Place::findOrFail($id);

        return view('places.edit', [
            'room' => $room,
            'place' => $place,
            
        ]);
    }

    public function update(Request $request, $id, $place_id)
    {

        $place = Place::where('room_id', $id)->findOrFail($place_id);
        $place->place_name = $request->place_name;
        $place->save();
        
        return back();
    }

    public function destroy($id, $place_id)
    {
        $place = Place::where('room_id', $id)->findOrFail($place_id);
        $place->delete();
        return redirect('/rooms/'.$id);
    }
    
}
