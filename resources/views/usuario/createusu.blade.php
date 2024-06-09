<form action="/usuario" method="POST">
        @csrf
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
            @error('nome')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" maxlength="12" value="{{ old('telefone') }}" required>
            @error('telefone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="datanasc">Data de Nascimento:</label>
            <input type="date" name="datanasc" id="datanasc" value="{{ old('datanasc') }}" required>
            @error('datanasc')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="tipousu">Tipo de Usuário:</label>
            <select name="tipousu" id="tipousu" required onchange="OcultarCnpj(this.value)">
                <option value="Cliente" {{ old('tipousu') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="Locador" {{ old('tipousu') == 'Locador' ? 'selected' : '' }}>Locador</option>
            </select>
            @error('tipousu')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" maxlength="11" value="{{ old('cpf') }}" required>
            @error('cpf')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div id="cnpjDiv" style="display: {{ old('tipousu') == 'Locador' ? 'block' : 'none' }};">
            <label for="cnpj">CNPJ:</label>
            <input type="text" name="cnpj" id="cnpj" maxlength="14" value="{{ old('cnpj') }}">
            @error('cnpj')
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
            <input type="submit" value="Enviar">
        </div>
    </form>
</div>

<script>
    function OcultarCnpj(tipoUsu) {
        var cnpjDiv = document.getElementById("cnpjDiv");
        if (tipoUsu === "Locador") {
            cnpjDiv.style.display = "block";
        } else {
            cnpjDiv.style.display = "none";
        }
    }
</script>
