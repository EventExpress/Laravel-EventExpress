<div>
    <form action="{{ url("/endereco/$endereco->id") }}" method="POST">
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar endereco</h1>
        <div>
            <label>
                <span>Cidade:</span>
                <input type="text" name="cidade" id="cidade" value="{{$endereco->cidade}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Cep:</span>
                <input type="number" name="cep" id="cep" maxlength="8" value="{{$endereco->cep}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Numero:</span>
                <input type="number" name="numero" id="numero" value="{{$endereco->numero}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Bairro:</span>
                <input type="text" name="bairro" id="bairro" value="{{$endereco->bairro}}" required>
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>

