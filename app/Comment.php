<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['nicknameId', 'placeId', 'comment'];
    protected $dates = ['created_at', 'updated_at'];

    public function place()
    {
        return $this->belongsTo('App\Place', 'placeId');
    }

    public function nickname()
    {
        return $this->belongsTo('App\Nickname', 'nicknameId');
    }
}
