<?php

namespace App\Interfaces\Estatisticas;

interface IEstatisticasService{
    /**
     * Retorna os dados agregados dos cadastros para a página de estatísticas.
     *
     * Este método busca, processa e agrupa os dados da tabela 'dados' para gerar
     * métricas como contagem total, distribuições por sexo, escolaridade, estado,
     * as 5 cidades com mais registros, e a média salarial. Em seguida, envia
     * esses dados para a view 'estatisticas.index' para renderizar os cards e gráficos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getEstatisticas(): array;
}
