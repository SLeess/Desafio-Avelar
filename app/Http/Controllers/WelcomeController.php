<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Exibe a página de boas-vindas com estatísticas básicas.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $totalCadastros = DB::selectOne('SELECT COUNT(id) as total FROM dados')->total ?? 0;
        $mediaIdade = DB::selectOne('SELECT AVG(idade) as media FROM dados')->media ?? 0;

        $stats = [
            'total' => $totalCadastros,
            'mediaIdade' => round($mediaIdade) // Arredonda a média de idade
        ];

        return view('welcome', ['stats' => $stats]);
    }
}
