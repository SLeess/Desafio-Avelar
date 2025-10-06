<div class="card shadow-sm">
        <div class="card-header bg-light">
            <h2 class="h4 mb-0">Registros Cadastrados</h2>
        </div>
        <div class="card-body">
            @if(count($registros) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Cidade</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $registro)
                                <tr>
                                    <th>{{ $registro->id }}</th>
                                    <td>{{ $registro->nome }}</td>
                                    <td>{{ $registro->idade }}</td>
                                    <td>{{ $registro->cidade }}</td>
                                    <td class="text-center">
                                        {{-- Rota para o formulário de edição --}}
                                        <a href="{{ route('cadastro.edit', $registro->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- Formulário para exclusão --}}
                                        <form action="{{ route('cadastro.destroy', $registro->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- PAGINAÇÃO --}}
                <div class="d-flex justify-content-center mt-3">
                    {!! $registros->links() !!}
                </div>
            @else
                <div class="alert alert-info text-center">
                    Nenhum registro encontrado.
                </div>
            @endif
        </div>
    </div>
</div>
