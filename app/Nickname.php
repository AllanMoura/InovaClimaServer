<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{

    protected $table = 'nicknames';
    protected $fillabe = [ 'nickname' ];
    protected $dates = ['created_at', 'updated_at'];

}
