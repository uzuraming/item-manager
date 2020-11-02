<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // 場所のモデルと関連付け
    public function places()
    {
        return $this->hasMany(Place::class);
    }
    
    // 場所詳細のモデルと関連付け
    public function place_details_from_room()
    {
        return $this->hasMany(PlaceDetail::class);
    }
    
    // 物品のモデルと関連付け
    public function item_from_room()
    {
        return $this->hasMany(Item::class);
    }
}
