@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-5 form-card-custom">
        <div class="card-header bg-blue-avelar text-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Editando Cadastro: {{ $registro->nome }}</h2>
            <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">Voltar para a lista</a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('cadastro.update', $registro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('pages.cadastros.partials.form', ['registro' => $registro])

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-md px-4">
                        <i class="bi bi-check-lg me-2"></i>Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
