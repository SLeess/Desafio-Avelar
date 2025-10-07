@extends('layouts.app')

@push('styles')
<style>
.collapse-icon {
    transition: transform 0.3s ease-in-out;
}

[data-bs-toggle="collapse"]:not(.collapsed) .collapse-icon {
    transform: rotate(180deg);
}
.form-floating .input-group-text {
    height: 100%;
}
.form-floating .form-control {
    border-radius: 0 var(--bs-border-radius) var(--bs-border-radius) 0 !important;
}
.form-card-custom {
    /* max-width: 900px; */
    margin-left: auto;
    margin-right: auto;
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
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Opa! Verifique os erros abaixo:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow-sm mb-5 form-card-custom">
        <button class="card-header bg-blue-avelar text-white text-start w-100 border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#formCollapse"
                aria-expanded="true"
                aria-controls="formCollapse">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h4 mb-0">Formulário de Cadastro</h2>
                <i class="bi bi-chevron-down collapse-icon"></i>
            </div>
        </button>

        <div class="collapse show" id="formCollapse">
            <div class="card-body p-4">
                <form action="{{route('cadastro.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @include("pages.cadastros.partials.form")

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary btn-md px-4">
                            <i class="bi bi-check-lg me-2"></i>Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection


@push('scripts')
<script>

    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const deleteUrl = button.getAttribute('data-delete-url');
        const form = document.getElementById('deleteForm');
        form.setAttribute('action', deleteUrl);
    });
</script>
<script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // Mascada de Telefone
        $("#telefone").mask("(99) 999999999")
            .blur(function(event) {
                var target, telefone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                telefone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (telefone.length > 10) {
                    element.mask("(99) 9 9999-9999");
                } else {
                    element.mask("(99) 9999-99999");
                }
            });

        //Nacionalidade
        $('#nacionalidade').ready(function() {
            var nacionalidade = $('#nacionalidade').val();
            var $div_paisorigem = $('#paisorigem')
            var $div_estados = $('#estados')
            if (nacionalidade == 'brasileira' || nacionalidade == '') {
                $div_estados.css("display", "block")
                $div_paisorigem.css("display", "none")
            } else {
                $div_estados.css("display", "none")
                $div_paisorigem.css("display", "block")
            }
        }).on('change', function() {
            var nacionalidade = $('#nacionalidade').val();
            var $div_paisorigem = $('#paisorigem')
            var $div_estados = $('#estados')
            if (nacionalidade == 'brasileira' || nacionalidade == '') {
                $div_estados.css("display", "block")
                $div_paisorigem.css("display", "none")
            } else {
                $div_estados.css("display", "none")
                $div_paisorigem.css("display", "block")
            }
        })

        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }


        });
    </script>
@endpush
