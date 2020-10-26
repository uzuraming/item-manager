<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
