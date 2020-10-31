<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['place_name'];

    // roomとの関係を書く
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    // 場所詳細のモデルと関連付け
    public function place_details_from_place()
    {
        return $this->hasMany(PlaceDetail::class);
    }
}
