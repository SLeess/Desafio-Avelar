<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EstatisticasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/desafio-avelar', [Controller::class, 'index'])->name('desafio.avelar.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/cadastros', CadastroController::class)
        ->only(['store', 'edit', 'update', 'destroy'])
        ->parameters(['cadastros' => 'cadastro'])
        ->names('cadastro');
    Route::get('/estatisticas', [EstatisticasController::class, 'index'])->name('estatisticas.index');
});


Auth::routes();

