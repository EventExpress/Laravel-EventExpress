<div>
    <form action="/usuario" method="POST">
        <div>
            <label for="nome">
                Nome:
            </label>
            <input type="text" name="nome" id="nome" required>
        </div>
        <div>
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" maxlength="12" required>
        </div>
        <div>
            <label for="email">
                E-mail:
            </label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="datanasc">
                Data de Nascimento:
            </label>
            <input type="date" name="datanasc" id="datanasc" required>
        </div>
        <div>
            <label for="tipousu">
                Tipo de Usuário:
            </label>
            </label>
            <select name="tipousu" id="tipousu" required onchange="OcultarCnpj(this.value)">
                <option value="Cliente">Cliente</option>
                <option value="Locador">Locador</option>
            </select>
        </div>
        <div>
            <label for="cpf">
                CPF:
            </label>
            <input type="text" name="cpf" id="cpf" maxlength="11" required>
        </div>
        <div id="cnpjDiv" style="display: none;">
            <label for="cnpj">
                CNPJ:
            </label>
            <input type="text" name="cnpj" id="cnpj" maxlength="14">
        </div>
        <div>
            <label for="cidade">
                Cidade:
            </label>
            <input type="text" name="cidade" id="cidade" required>
        </div>
        <div>
            <label for="cep">
                CEP:
            </label>
            <input type="text" name="cep" id="cep" required>
        </div>
        <div>
            <label for="numero">
                Número:
            </label>
            <input type="number" name="numero" id="numero" required>
        </div>
        <div>
            <label for="bairro">
                Bairro:
            </label>
            <input type="text" name="bairro" id="bairro" required>
        </div>
        <div>
            <input type="submit" value="Enviar">
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
