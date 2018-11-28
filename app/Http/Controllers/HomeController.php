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

    public function getAtlGo(){
        $estadio = "Estadio Atl Go - web";
        $jogadores = "Lista jogadores Atl Go-web";
        $titulo = "Lista titulo Atl Go-web";
        return response()->json(compact('estadio', 'jogadores', 'titulo'));
    }

    public function getAtlMg(){
        $estadio = "Estadio Atl Mg - web";
        $jogadores = "Lista jogadores Atl Mg-web";
        $titulo = "Lista titulo Atl Mg-web";
        return response()->json(compact('estadio', 'jogadores', 'titulo'));
    }

    public function getBotaFogo(){
        $estadio = "Estadio Bota Fogo - web";
        $jogadores = "Lista jogadores Bota Fogo-web";
        $titulo = "Lista titulo Bota Fogo-web";
        return response()->json(compact('estadio', 'jogadores', 'titulo'));
    }

    public function getBahia(){
        $estadio = "Estadio Bahia - web";
        $jogadores = "Lista jogadores Bahia-web";
        $titulo = "Lista titulo Bahia-web";
        return response()->json(compact('estadio', 'jogadores', 'titulo'));
    }
}
