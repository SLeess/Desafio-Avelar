@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-5">
    <div class="card-header bg-blue-avelar text-white">
        <h2 class="h4 mb-0">Formulário de Cadastro</h2>
    </div>

    <div class="card-body p-4">
        <form action="#" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row g-3">

                <div class="col-12 col-md-7">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    @error('nome') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>


                <div class="offset-0 offset-md-2 col-md-1">
                    <label for="idade" class="form-label">Idade</label>
                    <input type="number" class="form-control" id="idade" name="idade" required>
                </div>

                <div class="col-md-2">
                    <label for="salario" class="form-label">Salário (R$)</label>
                    <input type="text" class="form-control" id="salario" name="salario" placeholder="R$ 2.000,00" required>
                </div>

                <div class="col-md-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select" id="sexo" name="sexo" required>
                        <option value="" selected disabled>Selecione...</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <div class="mt-5 col-12">
                    <label for="anexo" class="form-label">Anexo (PDF, JPG, PNG - Máx 10MB)</label>
                    <input class="form-control" type="file" id="anexo" name="anexo" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <div class="col-12">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="ensino_medio" name="ensino_medio" value="1">
                        <label class="form-check-label" for="ensino_medio">
                            Possui Ensino Médio Completo
                        </label>
                    </div>
                </div>
            </div>


            <div class="row mt-5">
                <div class="form-group col-md-3">
                    <label for="cep">CEP</label>

                    <input type="text" id="cep" class="form-control @error('cep') is-invalid @enderror" name="cep"
                        data-mask="00000-000" placeholder="ex.: 39404-000" value="{{ old('cep') }}">
                    @error('cep')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        Não sabe? Consulte
                        <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">aqui!</a>
                    </small>
                    <small id="loading-cep" class="form-text text-muted d-none">
                        Consultando CEP...
                    </small>
                </div>

                <div class="form-group col-md-5">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" class="form-control @error('rua') is-invalid @enderror" name="rua"
                        placeholder="ex.: Rua 1" value="{{ old('rua') }}">
                    @error('rua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-2">
                    <label for="numero">Nº</label>
                    <input type="number" min="0" class="form-control @error('numero') is-invalid @enderror"
                        name="numero" placeholder="ex.: 39" value="{{ old('numero') }}">
                    @error('numero')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-2">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control @error('complemento') is-invalid @enderror" name="complemento"
                        placeholder="ex.: A" value="{{ old('complemento') }}">
                    @error('complemento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="form-group col-md-4">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" class="form-control @error('bairro') is-invalid @enderror"
                        name="bairro" placeholder="ex.: Acácias" value="{{ old('bairro') }}">
                    @error('bairro')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-5">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" class="form-control @error('cidade') is-invalid @enderror"
                        name="cidade" placeholder="ex.: Montes Claros" value="{{ old('cidade') }}">
                    @error('cidade')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="uf">Estado</label>
                    <select name="uf" id="uf" class="form-control @error('uf') is-invalid @enderror">
                        <option hidden value=""></option>
                            @include('components.estados', [
                                'inputName' => 'uf',
                            ])

                    </select>
                    @error('uf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary pe-2 btn-sm">
                    <i class="bi bi-check-lg me-2 fs-6 "></i>Salvar
                </button>
            </div>
        </form>
    </div>

</div>

<div class="card shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">Registros Cadastrados</h2>
        {{-- Aqui você pode adicionar filtros ou um campo de busca --}}
    </div>
    <div class="card-body">
        {{-- Simulando dados vindos do Controller. No seu código, use a variável real --}}
        @php
            $registros = [
                (object)['id' => 1, 'nome' => 'Ana Silva', 'idade' => 28, 'cidade' => 'São Paulo'],
                (object)['id' => 2, 'nome' => 'Bruno Costa', 'idade' => 35, 'cidade' => 'Rio de Janeiro'],
            ];
        @endphp

        @if(count($registros) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Idade</th>
                            <th scope="col">Cidade</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <tr>
                                <th scope="row">{{ $registro->id }}</th>
                                <td>{{ $registro->nome }}</td>
                                <td>{{ $registro->idade }}</td>
                                <td>{{ $registro->cidade }}</td>
                                <td class="text-center">
                                    {{-- Altere as rotas para as suas rotas de edit e destroy --}}
                                    <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                                        <i class="bi bi-pencil-square fs-8"></i>
                                    </a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Excluir"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        data-delete-url="#"
                                    >
                                        {{-- No data-delete-url, passe a rota de exclusão: {{ route('sua.rota.destroy', $registro->id) }} --}}
                                        <i class="bi bi-trash3 fs-8"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                Nenhum registro encontrado.
            </div>
        @endif
    </div>
</div>


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

    const cepMask = IMask(document.getElementById('cep'), {
        mask: '00000-000'
    });
    const salarioMask = IMask(document.getElementById('salario'), {
        mask: 'R$ num',
        blocks: {
            num: {
                mask: Number,
                thousandsSeparator: '.',
                radix: ',',
                scale: 2,
                padFractionalZeros: true
            }
        }
    });

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
