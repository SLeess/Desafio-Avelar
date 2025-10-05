<?php

namespace App\Services\Estatisticas;

use Illuminate\Support\Facades\DB;

class EstatisticasService implements \App\Interfaces\Estatisticas\IEstatisticasService{
    public function getEstatisticas(): array
    {
        $totalCadastros = DB::selectOne('SELECT COUNT(id) as total FROM dados')->total;

        $stats = [
            'total' => $totalCadastros,
            'porSexo' => [],
            'mediaSalarial' => 0,
            'porEnsinoMedio' => [],
            'porEstado' => [],
            'porCidadeTop5' => [],
        ];

        // Só executa as outras queries se houver cadastros
        if ($totalCadastros > 0) {
            // Contagem por sexo (já existente)
            $stats['porSexo'] = DB::select('SELECT sexo, COUNT(id) as total FROM dados GROUP BY sexo');

            // Média salarial
            $stats['mediaSalarial'] = DB::selectOne('SELECT AVG(salario) as media FROM dados')->media;

            // Contagem por nível de ensino médio
            $stats['porEnsinoMedio'] = DB::select('SELECT ensino_medio, COUNT(id) as total FROM dados GROUP BY ensino_medio');

            // Contagem por estado
            $stats['porEstado'] = DB::select('SELECT estado, COUNT(id) as total FROM dados GROUP BY estado ORDER BY total DESC');

            // Contagem das 5 cidades com mais cadastros
            $stats['porCidadeTop5'] = DB::select('SELECT cidade, COUNT(id) as total FROM dados GROUP BY cidade ORDER BY total DESC LIMIT 5');
        }

        return $stats;
    }
}
