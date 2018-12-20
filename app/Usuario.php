<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    
    protected $fillable =
    [
        'nickname', 'hash'
    ];

    protected $dates =['update_at', 'created_at'];
}
