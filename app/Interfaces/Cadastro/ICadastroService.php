<?php

namespace App\Interfaces\Cadastro;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

interface ICadastroService{

    /**
     * Busca e pagina itens pesquisados de cadastrados
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function indexCadastros(Request $request): LengthAwarePaginator;

    /**
     * Salva um novo registro de cadastro no banco de dados.
     *
     * @param array $data Dados validados do formulário.
     * @return bool Retorna true em caso de sucesso.
     * @throws Exception Em caso de falha no upload ou inserção.
     */
    public function storeCadastro(array $data);

    /**
     * Atualiza um registro de cadastro no banco de dados.
     *
     * @param array $data Dados validados do formulário.
     * @param string $id O ID do registro a ser atualizado.
     * @return bool
     * @throws Exception
     */
    public function updateCadastro(array $data, string $id): bool;

    /**
     * Remove um registro de cadastro do banco de dados e seu anexo.
     *
     * @param string $id O ID do registro a ser excluído.
     * @return bool Retorna true se a exclusão for bem-sucedida.
     * @throws Exception
     */
    public function deleteCadastro(string $id): bool;
}
