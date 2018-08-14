<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Previsao extends Model
{
    protected $table = 'previsoes';
    protected $fillable =
    [
        'placeId', 'periodo', 'maximaGrau', 'minimaGrau', 'descricao', 'estabilidadeTempo',
        'direcaoVento', 'intensidadeVento', 'umidArMax', 'umidArMin'
    ];
    protected $dates =['update_at', 'created_at'];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
