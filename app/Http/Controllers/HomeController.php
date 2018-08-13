<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Nickname;

class HomeController extends Controller
{
    public function version(){
        $name = "Inova Clima";
        $version = "0.1";
        return response()->json(compact('name', 'version'));
    }
}
