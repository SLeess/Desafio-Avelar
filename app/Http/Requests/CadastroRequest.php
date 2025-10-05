<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->salario) {
            $this->merge([
                'salario' => $this->cleanSalario($this->salario),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this);
        return [
            "nome" => 'required|string|min:3|max:150',
            "idade" => 'required|integer|min:1',
            "salario" => 'nullable|numeric|between:0,999999.99',
            "sexo" => 'required|in:masculino,feminino,outro|string',
            "anexo" => 'file|nullable|mimes:pdf,jpg,jpeg,png|max:10240',
            "ensino_medio" => 'nullable',
            "cep" => 'required|regex:/^\d{2}\.\d{3}\-\d{3}$/|string',
            "rua" => 'required|string',
            "numero" => 'required|string',
            "complemento" => 'string|nullable',
            "bairro" => 'required|string',
            "cidade" => 'required|string',
            "uf" => 'required|string',
        ];
    }

    /**
     * Função auxiliar para limpar a string do salário.
     */
    private function cleanSalario(string $salario): string
    {
        return str_replace(['.', ','], ['', '.'], preg_replace('/[^\d,.]/', '', $salario));
    }
}
