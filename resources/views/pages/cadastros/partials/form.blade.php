<h5 class="text-muted mb-4">Dados Pessoais</h5>
<div class="row g-3 mb-4">
    {{-- Linha 1: Nome --}}
    <div class="col-12">
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <div class="form-floating">
                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $registro->nome ?? '') }}" placeholder="Nome Completo" required>
                <label for="nome">Nome Completo</label>
            </div>
        </div>
        @error('nome') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    {{-- Linha 2: Idade, Salário e Sexo --}}
    <div class="col-md-3">
        <div class="form-floating">
            <input type="number" class="form-control @error('idade') is-invalid @enderror" id="idade" name="idade" value="{{ old('idade', $registro->idade ?? '') }}" placeholder="Idade" required min="1">
            <label for="idade">Idade</label>
        </div>
            @error('idade') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <div class="form-floating">
            <input type="text" class="form-control @error('salario') is-invalid @enderror" id="salario" name="salario" value="{{ old('salario', isset($registro) ? number_format($registro->salario, 2, ',', '') : '') }}" placeholder="Salário (R$)" required>
            <label for="salario">Salário (R$)</label>
        </div>
        @error('salario') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-5">
        <div class="form-floating">
            <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                <option value="" @if(!old('sexo')) selected @endif disabled>Selecione uma opção</option>
                <option value="masculino" @if(old('sexo', $registro->sexo ?? '') == 'masculino') selected @endif>Masculino</option>
                <option value="feminino" @if(old('sexo', $registro->sexo ?? '') == 'feminino') selected @endif>Feminino</option>
                <option value="outro" @if(old('sexo', $registro->sexo ?? '') == 'outro') selected @endif>Outro</option>
            </select>
            <label for="sexo">Sexo</label>
        </div>
        @error('sexo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    @if (isset($registro) && $registro->anexo)
        <div class="alert alert-light d-flex align-items-center justify-content-between p-2 mx-2 mb-2">
            <span>
                <i class="bi bi-paperclip me-2"></i>
                Arquivo atual: <strong>{{ basename($registro->anexo) }}</strong>
            </span>
            <a href="{{ Storage::url($registro->anexo) }}" class="btn btn-sm btn-outline-secondary" download>
                <i class="bi bi-download me-1"></i>
                Baixar
            </a>
        </div>
        <small class="form-text text-muted">Para substituir, escolha um novo arquivo abaixo. Deixe em branco para manter o atual.</small>
    @endif

    {{-- Linha 3: Anexo e Checkbox --}}
    <div class="col-md-9">
        <label for="anexo" class="form-label small text-muted">Anexo (PDF, JPG, PNG - Máx 10MB)</label>
        <input class="form-control @error('anexo') is-invalid @enderror" type="file" id="anexo" name="anexo" accept=".pdf,.jpg,.jpeg,.png">
        @error('anexo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 d-flex align-items-center justify-content-center pt-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="ensino_medio" name="ensino_medio" value="1" @if(old('ensino_medio', $registro->ensino_medio ?? '') == '1') checked @endif>
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
            <input type="text" id="cep" class="form-control @error('cep') is-invalid @enderror" name="cep" value="{{ old('cep', $registro->cep ?? '') }}" placeholder="CEP">
            <label for="cep">CEP</label>
        </div>
        @error('cep') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-9">
            <div class="form-floating">
            <input type="text" id="rua" class="form-control @error('rua') is-invalid @enderror" name="rua" value="{{ old('rua', $registro->rua ?? '') }}" placeholder="Rua">
            <label for="rua">Rua</label>
        </div>
        @error('rua') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    {{-- Linha 2: Número, Complemento e Bairro --}}
    <div class="col-md-3">
        <div class="form-floating">
            <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero', $registro->numero ?? '') }}" placeholder="Nº">
            <label for="numero">Nº</label>
        </div>
        @error('numero') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-9">
            <div class="form-floating">
            <input type="text" class="form-control @error('complemento') is-invalid @enderror" name="complemento" value="{{ old('complemento', $registro->complemento ?? '') }}" placeholder="Complemento">
            <label for="complemento">Complemento</label>
        </div>
        @error('complemento') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    {{-- Linha 3: Bairro, Cidade e Estado --}}
        <div class="col-md-5">
            <div class="form-floating">
            <input type="text" id="bairro" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro', $registro->bairro ?? '') }}" placeholder="Bairro">
            <label for="bairro">Bairro</label>
        </div>
        @error('bairro') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-5">
            <div class="form-floating">
            <input type="text" id="cidade" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade', $registro->cidade ?? '') }}" placeholder="Cidade">
            <label for="cidade">Cidade</label>
        </div>
        @error('cidade') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-2">
        <div class="form-floating">
            <select name="uf" id="uf" class="form-select @error('uf') is-invalid @enderror">
                <option value="" @if(!old('uf')) selected @endif disabled>Selecione</option>
                @include('components.estados', ['inputName' => 'uf', 'value' => $registro->estado ?? null])
            </select>
            <label for="uf">Estado</label>
        </div>
        @error('uf') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
</div>
