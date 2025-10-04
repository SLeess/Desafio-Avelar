<?php

namespace App\Services\Cadastro;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

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
}
