@extends('layouts.app')
@push('styles')
<style>
    body {
        background: linear-gradient(-45deg, #0d6efd, #2A55A3, #0dcaf0, #6610f2);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .card-glass {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .card-glass .card-header,
    .card-glass label,
    .card-glass a.btn-link {
        color: #f8f9fa;
    }
    .card-glass a.btn-link:hover {
        color: #ffffff;
    }

    .card-glass .form-control {
        background-color: rgba(255, 255, 255, 0.9);
    }
    .card-glass .form-control:focus {
        background-color: rgba(255, 255, 255, 1);
    }

    .card-glass .input-group-text {
        background-color: rgba(255, 255, 255, 0.9);
    }
    .card-glass input{
        font-size: 16px;
    }
</style>
@endpush
@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card card-glass border-0">
            <div class="card-body p-4 p-md-5">
                <h2 class="text-center text-black mb-4">Criar Conta</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome Completo">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                         <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Campo de Confirmação de Senha com Ícone --}}
                    <div class="input-group mb-4">
                         <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme a Senha">
                    </div>


                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Register') }}
                        </button>
                    </div>

                    <div class="text-center">
                        <a class="btn btn-link text-black" href="{{ route('login') }}">
                            Já tem uma conta? Faça login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
