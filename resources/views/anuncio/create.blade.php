<div>
    <h2>Adicionar Anúncio</h2>
    <form action="/anuncio" method="POST">
        @csrf
        <div>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
            @error('titulo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}" required>
            @error('cidade')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" value="{{ old('cep') }}" required>
            @error('cep')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="numero">Número:</label>
            <input type="number" name="numero" id="numero" value="{{ old('numero') }}" required>
            @error('numero')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}" required>
            @error('bairro')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="capacidade">Capacidade:</label>
            <input type="number" name="capacidade" id="capacidade" value="{{ old('capacidade') }}" required>
            @error('capacidade')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" value="{{ old('descricao') }}" required>
            @error('descricao')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" value="{{ old('valor') }}" required>
            @error('valor')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="agenda">Agenda:</label>
            <input type="date" name="agenda" id="agenda" value="{{ old('agenda') }}" required>
            @error('agenda')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="categoriaId">Escolher categoria</label>
            <select name="categoriaId[]" id="categoriaId">
                @foreach($categoria as $categorias)
                    <option value="{{ $categorias->id }}" {{ in_array($categorias->id, old('categoriaId', [])) ? 'selected' : '' }}>
                        {{ $categorias->titulo }} - Descrição: {{ $categorias->descricao }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>
</div>
