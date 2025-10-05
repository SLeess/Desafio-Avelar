@extends('layouts.app')

@push('styles')
<style>
    /* Estilo para a ilustração do Hero não ficar gigante */
    .hero-illustration {
        max-width: 450px;
        width: 100%;
        height: auto;
    }
    /* Efeito sutil de levantar o card de estatística no hover */
    .stat-card:hover {
        transform: translateY(-5px);
        transition: transform 0.2s ease-in-out;
    }
</style>
@endpush

@section('content')

{{-- ============================================= --}}
{{-- 1. SEÇÃO HERO --}}
{{-- ============================================= --}}
<div class="bg-light p-5 rounded-3 mb-5">
    <div class="container-fluid py-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold">Desafio Avelar</h1>
                <p class="fs-4">Uma plataforma completa para gerenciamento de cadastros, construída com o Laravel integrado ao Bootstrap 5.</p>
                @guest
                <div class="d-flex gap-2">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Criar Conta</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Fazer Login</a>
                </div>
                @endguest
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                {{-- <img alt="grupo avelar logo" style="width: 400px;" src="{{ asset('images/avelar-giant-logo-transparent.png') }}" /> --}}
                <svg class="hero-illustration" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#0D6EFD" d="M48.6,-57.8C61.4,-47.5,69.2,-31.6,71.2,-14.8C73.2,2,69.4,19.6,60.6,35.2C51.8,50.8,37.9,64.4,21.6,70.5C5.3,76.6,-13.3,75.2,-31,68.6C-48.7,62,-65.4,50.1,-72.6,34.5C-79.7,18.9,-77.2,-0.3,-69.6,-16.1C-62,-31.9,-49.3,-44.3,-35.6,-54.2C-21.9,-64.1,-7.2,-71.5,6.5,-74.1C20.2,-76.7,40.4,-73.4,48.6,-57.8Z" transform="translate(100 100)" />
                </svg>
            </div>
        </div>
    </div>
</div>


{{-- ============================================= --}}
{{-- 2. SEÇÃO DE ESTATÍSTICAS --}}
{{-- ============================================= --}}
<div class="container mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Nossa Comunidade em Números</h2>
        <p class="lead text-muted">Dados que mostram o crescimento da nossa plataforma.</p>
    </div>

    {{-- Verifica se há cadastros para mostrar os cards --}}
    @if($stats['total'] > 0)
    <div class="row text-center">
        {{-- Card: Total de Cadastros --}}
        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card shadow-sm h-100 stat-card">
                <div class="card-body">
                    <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                    <h3 class="card-title h1 fw-bold">{{ $stats['total'] }}</h3>
                    <p class="card-text text-muted">Pessoas Cadastradas</p>
                </div>
            </div>
        </div>

        {{-- Card: Média de Idade --}}
        <div class="col-md-6 col-lg-6 mb-4">
            <div class="card shadow-sm h-100 stat-card">
                <div class="card-body">
                    <i class="bi bi-person-badge display-4 text-success mb-3"></i>
                    <h3 class="card-title h1 fw-bold">{{ $stats['mediaIdade'] }} anos</h3>
                    <p class="card-text text-muted">É a Média de Idade</p>
                </div>
            </div>
        </div>
    </div>
    @else
    {{-- Mensagem para quando não há cadastros --}}
    <div class="text-center">
        <p class="lead text-muted">Ainda não temos estatísticas para mostrar. Seja o primeiro a se cadastrar!</p>
    </div>
    @endif
</div>


{{-- ============================================= --}}
{{-- 3. SEÇÃO DE CHAMADA FINAL (CTA) --}}
{{-- ============================================= --}}
<div class="container">
    <div class="row">
        <div class="col-12 text-center bg-light p-5 rounded-3">
            <h2 class="fw-bold">Pronto para Começar?</h2>
            <p class="lead text-muted">Crie sua conta gratuitamente e junte-se à nossa comunidade.</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">
                Cadastre-se Agora
                <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>
</div>
@endsection
