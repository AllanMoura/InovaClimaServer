<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';
    protected $fillable = ['nicknameId', 'placeId'];
    protected $dates = ['created_at', 'updated_at'];

    public function nickname()
    {
        return $this->belongsTo('App\Nickname');
    }
}
