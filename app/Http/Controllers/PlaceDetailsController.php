<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room; 
use App\Place; 
use App\PlaceDetail; 
use App\Item; 
use Auth; 
use App\User; 

class PlaceDetailsController extends Controller
{
    public function show($id, $place_id, $place_detail_id)
    {
        
        // idの値で場所詳細を検索して取得
        $place_detail = PlaceDetail::findOrFail($place_detail_id);
        $room = $place_detail->room()->findOrFail($id);
        $place = $place_detail->place()->findOrFail($place_id);
        $items = $place_detail->item_from_place_detail()->where('room_id', $id)->where('place_id', $place_id)->whereNotIn('status', [0, 2])->orderBy('created_at', 'desc')->paginate(10);
     

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
        if(Auth::user()->admin === config('const.ADMIN')){
            $place = Place::findOrFail($place_id);
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
        
        
        if(Auth::user()->admin === config('const.ADMIN')){
            $place = Place::findOrFail($place_id);
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
        
        if(Auth::user()->admin === config('const.ADMIN')){
            // idの値で場所詳細を検索して取得
            $place_detail = PlaceDetail::findOrFail($place_detail_id);
            $room = $place_detail->room()->findOrFail($id);
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
        
        if(Auth::user()->admin === config('const.ADMIN')){
            $place_detail = PlaceDetail::where('room_id', $id)->where('place_id', $place_id)->findOrFail($place_detail_id);
            $place_detail->place_detail_name = $request->place_detail_name;
            $place_detail->save();
        }
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }

    public function destroy($id, $place_id, $place_detail_id)
    {
        if(Auth::user()->admin === config('const.ADMIN')){
            $place_detail = PlaceDetail::where('room_id', $id)->where('place_id', $place_id)->findOrFail($place_detail_id);
            $place_detail->delete();
        }
        
        return redirect('/rooms/'.$id.'/'.$place_id);
    }
    
    
}
