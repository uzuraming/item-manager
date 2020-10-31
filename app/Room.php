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
}
