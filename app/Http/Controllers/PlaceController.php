<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Place;
use App\Nickname;
use App\Log;
use App\Previsao;
use Carbon\Carbon;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return response()->json(compact('places'));
    }

    public function editPrevisoes(Request $request){
        $input = $request->input();
        if(!isset($input['previsoes'])){
            return response()->json(['error' => 'Bad Request - previsoes is missing'], 400);
        }
        $previsoes = $input['previsoes'];
        $now = Carbon::now()->format('Y-m-d H:i:s');
        foreach($previsoes as $previsao){
            $previsaoAtual = Previsao::find($previsao['id']);
            if(!$previsaoAtual){
                return response()->json(['error' => 'Previsao Not Found'], 404);
            }
            $previsaoAtual->periodo = $previsao['periodo'];
            $previsaoAtual->icon = $previsao['icon'];
            $previsaoAtual->maximaGrau = $previsao['maximaGrau'];
            $previsaoAtual->minimaGrau = $previsao['minimaGrau'];
            $previsaoAtual->descricao = $previsao['descricao'];
            $previsaoAtual->estabilidadeTemp = $previsao['estabilidadeTemp'];
            $previsaoAtual->direcaoVento = $previsao['direcaoVento'];
            $previsaoAtual->intensidadeVento = $previsao['intensidadeVento'];
            $previsaoAtual->umidArMax = $previsao['umidArMax'];
            $previsaoAtual->umidArMin = $previsao['umidArMin'];
            $previsaoAtual->updated_at = $now;
            if(!$previsaoAtual->save()){
                return response()->json(['error' => 'Problema ao salvar Previsao'.$previsao['id'], 'status' => '500'], 500);
            }
        }

        return response()->json(compact('previsoes'));
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
        if(!isset($input['nicknameId'])){
            return response()->json(['error' => 'Bad Request - nicknameId is missing'], 400);
        }else{
            $nickname = Nickname::find($input['nicknameId']);
            //$nickname = Nickname::firstOrNew(['nickname' => $input['nickname']]);
            if(!$nickname){
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

    public function getPlace($placeId){
        $place = Place::find($placeId);
        if(!$place){
            return response()->json(['error' => 'Place Not Found'], 404);
        }
        return response()->json(compact('place'));
    }
}
