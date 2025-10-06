<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\Cadastro\ICadastroService::class, \App\Services\Cadastro\CadastroService::class);
        $this->app->bind(\App\Interfaces\Estatisticas\IEstatisticasService::class, \App\Services\Estatisticas\EstatisticasService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setlocale('pt_BR.utf8');
        Paginator::useBootstrapFive();
    }
}
