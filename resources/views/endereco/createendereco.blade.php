<div>
    <form action="/endereco" method="POST">
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
            <input type="submit" value="Enviar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>
