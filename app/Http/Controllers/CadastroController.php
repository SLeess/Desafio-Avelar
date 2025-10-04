<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
use App\Interfaces\Cadastro\ICadastroService;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function __construct(protected ICadastroService $cadastroService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CadastroRequest $request)
    {
        try {
            $cadastro = $this->cadastroService->storeCadastro($request->validated());

            return redirect()->route('home')->withErrors(['success' => 'Cadastro realizado com Sucesso!']);
        } catch (Exception $e) {
            Log::error('Erro ao criar cadastro: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ocorreu um erro ao salvar o cadastro. Tente novamente.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
