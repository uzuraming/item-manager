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
}
