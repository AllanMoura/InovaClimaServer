<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PrevisaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = 'previsoes';
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $previsoes =[];
        $estabilidades = ['Estavel', 'Instavel'];
        $direcao = ['Norte', 'Sul', 'Leste', 'Oeste'];
        $intensidade = ['Fracos e moderados', 'Fortes'];
        $maxLoop = 97;
        for($i = 0; $i < $maxLoop; ++$i){
            $previsoes[$i*3 + 0] = ['placeId' => $i + 1, 'periodo' => 'Manha', 'icon' => rand(1, 3), 'maximaGrau' => rand(25, 38), 'minimaGrau' => rand(15, 24), 'descricao' => 'Lorem Ipsum', 'estabilidadeTemp' => $estabilidades[rand(0,1)], 'direcaoVento' =>  $direcao[rand(0,3)], 'intensidadeVento' => $intensidade[rand(0, 1)], 'umidArMax' => rand(50, 99), 'umidArMin' => rand(15, 49), 'updated_at' => $now, 'created_at' => $now];
            $previsoes[$i*3 + 1] = ['placeId' => $i + 1, 'periodo' => 'Tarde', 'icon' => rand(1, 3), 'maximaGrau' => rand(25, 38), 'minimaGrau' => rand(15, 24), 'descricao' => 'Lorem Ipsum', 'estabilidadeTemp' => $estabilidades[rand(0,1)], 'direcaoVento' =>  $direcao[rand(0,3)], 'intensidadeVento' => $intensidade[rand(0, 1)], 'umidArMax' => rand(50, 99), 'umidArMin' => rand(15, 49), 'updated_at' => $now, 'created_at' => $now];
            $previsoes[$i*3 + 2] = ['placeId' => $i + 1, 'periodo' => 'Noite', 'icon' => rand(1, 3), 'maximaGrau' => rand(25, 38), 'minimaGrau' => rand(15, 24), 'descricao' => 'Lorem Ipsum', 'estabilidadeTemp' => $estabilidades[rand(0,1)], 'direcaoVento' =>  $direcao[rand(0,3)], 'intensidadeVento' => $intensidade[rand(0, 1)], 'umidArMax' => rand(50, 99), 'umidArMin' => rand(15, 49), 'updated_at' => $now, 'created_at' => $now];
        }

        DB::table($table)->insert($previsoes);
    }
}
