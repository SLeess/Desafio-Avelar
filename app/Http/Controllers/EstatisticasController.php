<?php

namespace App\Http\Controllers;

use App\Interfaces\Estatisticas\IEstatisticasService;

class EstatisticasController extends Controller
{
    public function __construct(protected IEstatisticasService $estatisticaService)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $stats = $this->estatisticaService->getEstatisticas();
            return view('pages.estatisticas.index', ['stats' => $stats]);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
