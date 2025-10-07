<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
use App\Interfaces\Cadastro\ICadastroService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CadastroController extends Controller
{
    public function __construct(protected ICadastroService $cadastroService){}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index(Request $request)
    {
        try {
            $registros = $this->cadastroService->indexCadastros($request);

            return view('pages.cadastros.index', [
                'registros' => $registros
            ]);
        } catch (Exception $e) {
            Log::error('Erro ao criar cadastro: ' . $e->getMessage());

            return redirect()->view('welcome')
                ->withErrors(['error' => 'Ocorreu um erro ao salvar o cadastro. Tente novamente.']);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CadastroRequest $request)
    {
        try {
            $cadastro = $this->cadastroService->storeCadastro($request->validated());

            return redirect()->route('home')->with('success', 'Cadastro realizado com Sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao criar cadastro: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocorreu um erro ao salvar o cadastro. Tente novamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registro = DB::selectOne('SELECT * FROM dados WHERE id = ?', [$id]);

        if (!$registro) {
            return redirect()->route('home')->withErrors(['error' => 'Registro não encontrado.']);
        }

        return view('pages.cadastros.edit', ['registro' => $registro]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CadastroRequest $request, string $id)
    {
        try {
            $this->cadastroService->updateCadastro($request->validated(), $id);
            return redirect()->route('home')->with('success', 'Cadastro atualizado com Sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar cadastro: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocorreu um erro ao atualizar o cadastro. Tente novamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        try {
            $this->cadastroService->deleteCadastro($id);
            return redirect()->route('home')->with('success', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao excluir cadastro (ID: $id): " . $e->getMessage());
            return redirect()->route('home')->withErrors(['error' => 'Ocorreu um erro ao excluir o registro.']);
        }
    }
}
