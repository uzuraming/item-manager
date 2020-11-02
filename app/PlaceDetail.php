<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceDetail extends Model
{
    protected $fillable = ['place_detail_name'];
    
    // roomとの関係を記述
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    // placeとの関係を記述
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
    
    // 物品のモデルと関連付け
    public function item_from_place_detail()
    {
        return $this->hasMany(Item::class);
    }
}
