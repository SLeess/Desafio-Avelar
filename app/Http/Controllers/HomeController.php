<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $perPage = 5;

        $currentPage = Paginator::resolveCurrentPage('page');

        $total = DB::selectOne('SELECT COUNT(*) as total FROM dados')->total;

        $offset = ($currentPage - 1) * $perPage;

        $items = DB::select("SELECT * FROM dados ORDER BY id DESC LIMIT ? OFFSET ?", [$perPage, $offset]);

        $registros = new LengthAwarePaginator(
            $items,                // Os itens da página atual
            $total,                // O total de itens
            $perPage,            // Itens por página
            $currentPage,    // A página atual
            [
                'path' => Paginator::resolveCurrentPath(),
            ]
        );
        return view('pages.cadastros.index', [
            'registros' => $registros
        ]);
    }
}
