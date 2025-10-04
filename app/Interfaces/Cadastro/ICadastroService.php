<?php

namespace App\Interfaces\Cadastro;

interface ICadastroService{

    /**
     * Salva um novo registro de cadastro no banco de dados.
     *
     * @param array $data Dados validados do formulário.
     * @return bool Retorna true em caso de sucesso.
     * @throws Exception Em caso de falha no upload ou inserção.
     */
    public function storeCadastro(array $data);
}
