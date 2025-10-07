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
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .card-glass .card-header,
    .card-glass label {
        color: #f8f9fa;
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
        font-size: 15px;
    }
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1070;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.4); // Fundo escuro semitransparente
        backdrop-filter: blur(3px);

        opacity: 1;
        transition: opacity 0.3s ease;
        pointer-events: auto;
    }

    .loader-overlay.d-none {
        opacity: 0;
        pointer-events: none; // Garante que não bloqueie cliques quando escondido
    }
</style>
@endpush
@section('content')

<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card card-glass border-0">
            <div class="card-body p-4 p-md-5" style="background-color: white;">
                <div class="mb-4 text-center">
                    <img src="{{asset('images/logo_somente_A.jpg')}}" style="width: 130px;" alt="">
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input id="email" style="text-size: 10px;" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                         <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Senha">
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-black" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Login') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="btn btn-link text-black" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
