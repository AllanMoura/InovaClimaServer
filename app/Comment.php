<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['usuarioId', 'placeId', 'comment'];
    protected $dates = ['created_at', 'updated_at'];

    public function place()
    {
        return $this->belongsTo('App\Place', 'placeId');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'usuarioId');
    }
}
