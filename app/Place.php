<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';
    protected $fillable = ['cidade', 'bairro'];
    protected $dates = ['created_at', 'updated_at'];

    public function previsoes()
    {
        return $this->hasMany('App\Previsao', 'placeId');
    }
}
