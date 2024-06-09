<div>
    <form action="{{ url("/endereco/$endereco->id") }}" method="POST">
        @csrf
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar Endereço</h1>
        <div>
            <label>
                <span>Cidade:</span>
                <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $endereco->cidade) }}" required>
                @error('cidade')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Cep:</span>
                <input type="number" name="cep" id="cep" maxlength="8" value="{{ old('cep', $endereco->cep) }}" required>
                @error('cep')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Número:</span>
                <input type="number" name="numero" id="numero" value="{{ old('numero', $endereco->numero) }}" required>
                @error('numero')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Bairro:</span>
                <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $endereco->bairro) }}" required>
                @error('bairro')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>
