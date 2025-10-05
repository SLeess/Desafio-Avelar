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
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}
</style>
@endpush

@section('content')
<div class="container">
    @if ($errors->any())
    {{-- @dd($errors) --}}
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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

    <h5 class="text-muted mb-4">Dados Pessoais</h5>
    <div class="row g-3 mb-4">
        {{-- Linha 1: Nome --}}
        <div class="col-12">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <div class="form-floating">
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Nome Completo" required>
                    <label for="nome">Nome Completo</label>
                </div>
            </div>
            @error('nome') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Linha 2: Idade, Salário e Sexo --}}
        <div class="col-md-3">
            <div class="form-floating">
                <input type="number" class="form-control @error('idade') is-invalid @enderror" id="idade" name="idade" value="{{ old('idade') }}" placeholder="Idade" required min="1">
                <label for="idade">Idade</label>
            </div>
             @error('idade') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-control @error('salario') is-invalid @enderror" id="salario" name="salario" value="{{ old('salario') }}" placeholder="Salário (R$)" required>
                <label for="salario">Salário (R$)</label>
            </div>
            @error('salario') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-5">
            <div class="form-floating">
                <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                    <option value="" @if(!old('sexo')) selected @endif disabled>Selecione uma opção</option>
                    <option value="masculino" @if(old('sexo') == 'masculino') selected @endif>Masculino</option>
                    <option value="feminino" @if(old('sexo') == 'feminino') selected @endif>Feminino</option>
                    <option value="outro" @if(old('sexo') == 'outro') selected @endif>Outro</option>
                </select>
                <label for="sexo">Sexo</label>
            </div>
            @error('sexo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Linha 3: Anexo e Checkbox --}}
        <div class="col-md-9">
            <label for="anexo" class="form-label small text-muted">Anexo (PDF, JPG, PNG - Máx 10MB)</label>
            <input class="form-control @error('anexo') is-invalid @enderror" type="file" id="anexo" name="anexo" accept=".pdf,.jpg,.jpeg,.png">
            @error('anexo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-3 d-flex align-items-center justify-content-center pt-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="ensino_medio" name="ensino_medio" value="1" @if(old('ensino_medio') == '1') checked @endif>
                <label class="form-check-label" for="ensino_medio">Ensino Médio</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <h5 class="text-muted mb-4">Endereço</h5>
    <div class="row g-3">
        {{-- Linha 1: CEP e Rua --}}
        <div class="col-md-3">
            <div class="form-floating">
                <input type="text" id="cep" class="form-control @error('cep') is-invalid @enderror" name="cep" value="{{ old('cep') }}" placeholder="CEP">
                <label for="cep">CEP</label>
            </div>
            @error('cep') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-9">
             <div class="form-floating">
                <input type="text" id="rua" class="form-control @error('rua') is-invalid @enderror" name="rua" value="{{ old('rua') }}" placeholder="Rua">
                <label for="rua">Rua</label>
            </div>
            @error('rua') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Linha 2: Número, Complemento e Bairro --}}
        <div class="col-md-3">
            <div class="form-floating">
                <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') }}" placeholder="Nº">
                <label for="numero">Nº</label>
            </div>
            @error('numero') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-9">
             <div class="form-floating">
                <input type="text" class="form-control @error('complemento') is-invalid @enderror" name="complemento" value="{{ old('complemento') }}" placeholder="Complemento">
                <label for="complemento">Complemento</label>
            </div>
            @error('complemento') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- Linha 3: Bairro, Cidade e Estado --}}
         <div class="col-md-5">
             <div class="form-floating">
                <input type="text" id="bairro" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro') }}" placeholder="Bairro">
                <label for="bairro">Bairro</label>
            </div>
            @error('bairro') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-5">
             <div class="form-floating">
                <input type="text" id="cidade" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade') }}" placeholder="Cidade">
                <label for="cidade">Cidade</label>
            </div>
            @error('cidade') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <select name="uf" id="uf" class="form-select @error('uf') is-invalid @enderror">
                    <option value="" @if(!old('uf')) selected @endif disabled>Selecione</option>
                    @include('components.estados', ['inputName' => 'uf'])
                </select>
                <label for="uf">Estado</label>
            </div>
            @error('uf') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary btn-lg px-4">
            <i class="bi bi-check-lg me-2"></i>Salvar
        </button>
    </div>
                </form>
            </div>
        </div>

    </div>


@include('components.cadastrados')

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Você tem certeza que deseja excluir este registro? Esta ação não pode ser desfeita.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="deleteForm" action="" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
        </form>
      </div>
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
