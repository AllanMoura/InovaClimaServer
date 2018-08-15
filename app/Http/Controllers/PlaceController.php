<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Place;
use App\Nickname;
use App\Log;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return response()->json(compact('places'));
    }

    public function createPlace(Request $request)
    {
        $input = $request->input();
        if(!isset($input['cidade'])){
            return response()->json(['error' => 'Bad Request - cidade is missing'], 400);
        }else if(!isset($input['bairro'])){
            return response()->json(['error' => 'Bad Request - bairro is missing'], 400);    
        }
        $place = Place::firstOrNew(['cidade' => $input['cidade'], 'bairro' => $input['bairro']]);
        if($place->id == null){
            $place->cidade = $input['cidade'];
            $place->bairro = $input['bairro'];
            if($place->save()){
                return response()->json(compact('place'));
            }
        }else{
            return response()->json(['error' => 'local com mesma cidade e bairro existente', 'status' => '500'], 500);
        }
    }

    public function searchPlaces(Request $request)
    {
        $input = $request->input();
        if(!isset($input['query'])){
            return response()->json(['error' => 'Bad Request - query is missing'], 400);
        }
        if($input['query'] == null){
            return response()->json(['error' => 'Preencha a barra de busca'], 400);
        }
        if(!isset($input['nickname'])){
            return response()->json(['error' => 'Bad Request - nickname is missing'], 400);
        }else{
            $nickname = Nickname::firstOrNew(['nickname' => $input['nickname']]);
            if($nickname->id == null){
                return response()->json(['error' => 'nickname not registered'], 401);
            }else{
                $log = new Log();
                $log->acao = 'Pesquisar';
                $log->descricao = 'Pesquisa: '.$input['query'];
                $log->nicknameId = $nickname->id;
                $log->save();
            }
        }
        
       

        $query = $input['query'];
        $pieces = explode(" ", $query);

        $places = collect();
        foreach($pieces as $part){
            //$list = Place::where('bairro', "ILIKE", "%".$part."%")->get();
            $list = Place::where('bairro', "ILIKE", "%".$part."%")->with('previsoes')->get();
            $places = $places->merge($list);
        }
        $places = $places->sort(function($a, $b) use ($query){
            if(levenshtein($a->bairro, $query) == levenshtein($b->bairro, $query)){
                return 0;
            }

            return (levenshtein($a->bairro, $query) < levenshtein($b->bairro, $query)) ? -1:1;
        });

        $places = $places->unique()->values()->all();

        return response()->json(compact('places'));
    }
}
