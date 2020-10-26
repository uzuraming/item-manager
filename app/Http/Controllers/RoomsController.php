<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room; // 追加

use App\Place; // 追加

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 部屋一覧を取得
        $rooms = Room::all();

        // 部屋一覧ビューでそれを表示
        return view('rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room = new Room;

        // 部屋作成ビューを表示
        return view('rooms.create', [
            'room' => $room,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 部屋を作成
        $room = new Room;
        $room->room_name = $request->room_name;
        $room->save();
        
        return redirect('/rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値で部屋を検索して取得
        $room = Room::findOrFail($id);
        // 場所一覧を取得
        $places = $room->places()->orderBy('created_at', 'desc')->paginate(10);

        // 部屋詳細ビューでそれを表示
        return view('rooms.show', [
            'room' => $room,
            'places' => $places,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値で部屋を検索して取得
        $room = Room::findOrFail($id);

        // 部屋編集ビューでそれを表示
        return view('rooms.edit', [
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idの値で部屋を検索して取得
        $room = Room::findOrFail($id);
        // メッセージを更新
        $room->room_name = $request->room_name;
        $room->save();

        // トップページへリダイレクトさせる
        return redirect('/rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値で部屋を検索して取得
        $room = Room::findOrFail($id);
        // 部屋を削除
        $room->delete();

        // 部屋一覧へリダイレクトさせる
        return redirect('/rooms');
    }
}
