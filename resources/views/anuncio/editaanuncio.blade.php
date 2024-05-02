<div>
    <form action="{{ route('anuncio.update', $anuncio->id) }}" method="POST">
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar anuncio</h1>
        <div>
            <label>
                <span>Titulo:</span>
                <input type="text" name="titulo" id="titulo" value="{{$anuncio->titulo}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Cidade:</span>
                <input type="text" name="cidade" id="cidade" value="{{$anuncio->endereco->cidade}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>CEP:</span>
                <input type="text" name="cep" id="cep" value="{{$anuncio->endereco->cep}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Número:</span>
                <input type="number" name="numero" id="numero" value="{{$anuncio->endereco->numero}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Bairro:</span>
                <input type="text" name="bairro" id="bairro" value="{{$anuncio->endereco->bairro}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Capacidade:</span>
                <input type="number" name="capacidade" id="capacidade" value="{{$anuncio->capacidade}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Descrição:</span>
                <input type="text" name="descricao" id="descricao" value="{{$anuncio->descricao}}" required>
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>

