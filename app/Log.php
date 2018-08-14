<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = ['acao', 'descricao', 'nicknameId'];  
    protected $dates = ['created_at', 'updated_at'];
    
    public function nickname()
    {
        return $this->belongsTo('App\Nickname');
    }
}
