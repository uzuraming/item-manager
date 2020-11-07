<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'admin', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // 物品のモデルと関連付け
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    
    /**
     * このユーザが使用した物品データ。（Itemモデルとの関係を定義）
     */
    public function item_history()
    {
        return $this->belongsToMany(User::class, 'item_history', 'user_id', 'item_id')->withTimestamps()->withPivot('amount');;
    }
}
