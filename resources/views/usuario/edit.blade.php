<div>
    <form action="{{ url("/usuario/$usuario->id") }}" method="POST">
        @csrf
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar Usuario</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <label>
                <span>Nome:</span>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $usuario->nome->nome) }}" required>
                @error('nome')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Telefone:</span>
                <input type="text" name="telefone" id="telefone" maxlength="12" value="{{ old('telefone', $usuario->telefone) }}" required>
                @error('telefone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>E-mail:</span>
                <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" required>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Data de Nascimento:</span>
                <input type="date" name="datanasc" id="datanasc" value="{{ old('datanasc', $usuario->datanasc) }}" required>
                @error('datanasc')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>CPF:</span>
                <input type="text" name="cpf" id="cpf" maxlength="14" value="{{ old('cpf', $usuario->cpf) }}" required>
                @error('cpf')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Tipo de Usuário:</span>
                <select name="tipousu" id="tipousu" required onchange="OcultarCnpj(this.value)">
                    <option value="" disabled selected>Selecione o tipo de usuário</option>
                    <option value="Cliente" {{ old('tipousu', $usuario->tipousu) == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="Locador" {{ old('tipousu', $usuario->tipousu) == 'Locador' ? 'selected' : '' }}>Locador</option>
                </select>
                @error('tipousu')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div id="cnpjDiv" style="display: {{ old('tipousu', $usuario->tipousu) == 'Locador' ? 'block' : 'none' }};">
            <label>
                <span>CNPJ:</span>
                <input type="text" name="cnpj" id="cnpj" maxlength="14" value="{{ old('cnpj', $usuario->cnpj) }}">
            </label>
        </div>
        <div>
            <label>
                <span>Cidade:</span>
                <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $usuario->endereco->cidade) }}" required>
                @error('cidade')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>CEP:</span>
                <input type="text" name="cep" id="cep" value="{{ old('cep', $usuario->endereco->cep) }}" required>
                @error('cep')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Número:</span>
                <input type="number" name="numero" id="numero" value="{{ old('numero', $usuario->endereco->numero) }}" required>
                @error('numero')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div>
            <label>
                <span>Bairro:</span>
                <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $usuario->endereco->bairro) }}" required>
                @error('bairro')
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
