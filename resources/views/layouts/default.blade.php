<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style type="text/css">
        i {
            font-size: 50px;
        }
    </style>
    @stack('styles')

</head>

<body class="h-100 p-2">
    <header class="pb-3 mb-4 border-bottom mt-2">
        <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
            <img src="{{ asset('images/logo_somente_A.jpg') }}" style="width: 40px" class="me-2" alt="Logo Avelar">
            <span class="fs-4">Desafio Avelar - Projeto</span>
        </a>
    </header>

    <div class="wrapper">
        <main class="container py-1">
            @yield('content')
        </main>

    </div>

    <footer class="pt-3 mt-4 text-body-secondary border-top mb-2 text-center" style="width: 95vw;">
        Leandro - © {{ date('Y') }}
    </footer>

    <script>
        $(function() {
            toastr.success("tada");
        })
    </script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script>
        $(function() {
            $(':input').change(function() {
                $(this).removeClass('is-invalid');
            });

            @if (session()->has('middleware_error'))
                toastr.warning("{{ session('middleware_error') }}")
            @endif
            @if ($errors->has('success'))
                toastr.success("{{ $errors->first('success') }}")
            @elseif ($errors->has('warning'))
                toastr.warning("{{ $errors->first('warning') }}")
            @elseif ($errors->has('info'))
                toastr.info("{{ $errors->first('info') }}")
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}")
                @endforeach
            @endif

        });
    </script>

    @stack('scripts')

</body>
</html>
