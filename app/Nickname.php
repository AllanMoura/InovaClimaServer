<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    protected $table = 'nicknames';
    protected $fillable = ['nickname', 'hash'];
    protected $dates = ['created_at', 'updated_at'];

    public function favoritos()
    {
        return $this->hasMany('App\Favorito', 'nicknameId');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'nicknameId');
    }
}
