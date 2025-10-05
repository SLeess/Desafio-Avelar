<?php

namespace App\Services\Cadastro;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Storage;

class CadastroService implements \App\Interfaces\Cadastro\ICadastroService{
    public function storeCadastro(array $data){
        try {
            $pathAnexo = $data['anexo']->store('anexos', 'public');

            if (!$pathAnexo) {
                throw new Exception("Falha no upload do arquivo anexo.");
            }

            $dadosParaInserir = [
                'nome'         => $data['nome'],
                'idade'        => $data['idade'],
                'cep'          => $data['cep'],
                'cidade'       => $data['cidade'],
                'estado'       => $data['uf'],
                'rua'          => $data['rua'],
                'bairro'       => $data['bairro'],
                'ensino_medio' => $data['ensino_medio'] ?? 0,
                'sexo'         => $data['sexo'],
                'salario'      => $data['salario'] ?? 0.00,
                'anexo'        => $pathAnexo,
                'numero'       => $data['numero'] ?? null,
                'complemento'  => $data['complemento'] ?? null,
            ];

            // dd($dadosParaInserir);


            //  para prevenir SQL Injection.
            $sql = "
                INSERT INTO dados
                (nome, idade, cep, cidade, estado, rua, bairro, ensino_medio, sexo, salario, anexo, numero, complemento)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";

            $bindings = [
                $dadosParaInserir['nome'],
                $dadosParaInserir['idade'],
                $dadosParaInserir['cep'],
                $dadosParaInserir['cidade'],
                $dadosParaInserir['estado'],
                $dadosParaInserir['rua'],
                $dadosParaInserir['bairro'],
                $dadosParaInserir['ensino_medio'],
                $dadosParaInserir['sexo'],
                $dadosParaInserir['salario'],
                $dadosParaInserir['anexo'],
                $dadosParaInserir['numero'],
                $dadosParaInserir['complemento']
            ];

            return DB::insert($sql, $bindings);

        } catch (Exception $e) {
            Log::error("Erro ao salvar cadastro: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Atualiza um registro de cadastro no banco de dados.
     *
     * @param array $data Dados validados do formulário.
     * @param string $id O ID do registro a ser atualizado.
     * @return bool
     * @throws Exception
     */
    public function updateCadastro(array $data, string $id): bool
    {
        try {
            $registroAntigo = DB::selectOne('SELECT anexo FROM dados WHERE id = ?', [$id]);

            if (isset($data['anexo'])) {
                if ($registroAntigo && $registroAntigo->anexo) {
                    Storage::disk('public')->delete($registroAntigo->anexo);
                }
                $pathAnexo = $data['anexo']->store('anexos', 'public');
            } else {
                $pathAnexo = $registroAntigo->anexo ?? null;
            }

            $dadosParaUpdate = [
                $data['nome'],
                $data['idade'],
                $data['cep'],
                $data['cidade'],
                $data['uf'],
                $data['rua'],
                $data['bairro'],
                $data['ensino_medio'] ?? 0,
                $data['sexo'],
                $data['salario'] ?? 0.00,
                $pathAnexo,
                $data['numero'] ?? null,
                $data['complemento'] ?? null,
                $id
            ];

            $sql = "
                UPDATE dados SET
                nome = ?, idade = ?, cep = ?, cidade = ?, estado = ?, rua = ?,
                bairro = ?, ensino_medio = ?, sexo = ?, salario = ?, anexo = ?,
                numero = ?, complemento = ?
                WHERE id = ?
            ";

            return DB::update($sql, $dadosParaUpdate);

        } catch (Exception $e) {
            Log::error("Erro ao atualizar cadastro (ID: $id): " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteCadastro(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $registro = DB::selectOne('SELECT anexo FROM dados WHERE id = ?', [$id]);

            if (!$registro) {
                throw new Exception("Registro com ID {$id} não encontrado.");
            }

            if ($registro->anexo) {
                Storage::disk('public')->delete($registro->anexo);
            }

            $linhasAfetadas = DB::delete('DELETE FROM dados WHERE id = ?', [$id]);

            return $linhasAfetadas > 0;
        });
    }
}
