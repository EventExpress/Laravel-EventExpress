<div>
    <form action="{{ url("/usuario/$usuario->id") }}" method="POST">
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar Usuario</h1>
        <div>
            <label>
                <span>Nome:</span>
                <input type="text" name="nome" id="nome" value="{{$usuario->nome}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Telefone:</span>
                <input type="text" name="telefone" id="telefone" maxlength="12" value="{{$usuario->telefone}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>E-mail:</span>
                <input type="email" name="email" id="email" value="{{$usuario->email}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Data de Nascimento:</span>
                <input type="date" name="datanasc" id="datanasc" value="{{$usuario->datanasc}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>CPF:</span>
                <input type="text" name="cpf" id="cpf" maxlength="14" value="{{$usuario->cpf}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Tipo de Usuário:</span>
                <select name="tipousu" id="tipousu" required onchange="OcultarCnpj(this.value)">
                    <option value="" disabled selected>Selecione o tipo de usuário</option>
                    <option value="Cliente" {{$usuario->tipousu == 'Cliente' ? 'selected' : ''}}>Cliente</option>
                    <option value="Locador" {{$usuario->tipousu == 'Locador' ? 'selected' : ''}}>Locador</option>
                </select>
            </label>
        </div>
        <div id="cnpjDiv" style="display: {{$usuario->tipousu == 'Locador' ? 'block' : 'none'}};">
            <label>
                <span>CNPJ:</span>
                <input type="text" name="cnpj" id="cnpj" maxlength="14" value="{{$usuario->cnpj}}">
            </label>
        </div>
        <div>
            <label>
                <span>Endereço:</span>
                <input type="text" name="endereco" id="endereco" value="{{$usuario->endereco}}" required>
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
