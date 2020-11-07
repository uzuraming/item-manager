<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // roomとの関係を書く
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    // placeとの関係を記述
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    
    // place_detailとの関係を記述
    public function place_detail()
    {
        return $this->belongsTo(PlaceDetail::class);
    }
    
    // usersとの関係を記述
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この物品が使用したユーザーデータ。（Userモデルとの関係を定義）
     */
    public function user_history()
    {
        return $this->belongsToMany(User::class, 'item_history', 'item_id', 'user_id')->withTimestamps()->withPivot('amount');
    }
    
}
