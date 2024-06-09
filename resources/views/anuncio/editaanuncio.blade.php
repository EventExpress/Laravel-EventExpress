<div>
    <form action="{{ route('anuncio.update', $anuncio->id) }}" method="POST">
        @csrf
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar anúncio</h1>
        <div>
            <label>
                <span>Título:</span>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $anuncio->titulo) }}" required>
                @error('titulo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Cidade:</span>
                <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $anuncio->endereco->cidade) }}" required>
                @error('cidade')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>CEP:</span>
                <input type="text" name="cep" id="cep" value="{{ old('cep', $anuncio->endereco->cep) }}" required>
                @error('cep')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Número:</span>
                <input type="number" name="numero" id="numero" value="{{ old('numero', $anuncio->endereco->numero) }}" required>
                @error('numero')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Bairro:</span>
                <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $anuncio->endereco->bairro) }}" required>
                @error('bairro')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Capacidade:</span>
                <input type="number" name="capacidade" id="capacidade" value="{{ old('capacidade', $anuncio->capacidade) }}" required>
                @error('capacidade')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Descrição:</span>
                <input type="text" name="descricao" id="descricao" value="{{ old('descricao', $anuncio->descricao) }}" required>
                @error('descricao')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>
