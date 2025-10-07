<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EstatisticasController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/desafio-avelar', [App\Http\Controllers\HomeController::class, 'index'])->name(name: 'desafio.avelar.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/cadastros', CadastroController::class)
        ->except([ 'show', 'create'])
        ->parameters(['cadastros' => 'cadastro'])
        ->names('cadastro');
    Route::get('/estatisticas', [EstatisticasController::class, 'index'])->name('estatisticas.index');
});


Auth::routes();

