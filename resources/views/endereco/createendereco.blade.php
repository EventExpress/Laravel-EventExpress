<div>
    <form action="/endereco" method="POST">
        <div>
            <label for="cidade">
                Cidade:
            </label>
            <input type="text" name="cidade" id="cidade" required>
        </div>
        <div>
            <label for="cep">
                Cep:
            </label>
            <input type="number" name="cep" id="cep" maxlength="8" required>
        </div>
        <div>
            <label for="numero">
                Numero:
            </label>
            <input type="number" name="numero" id="numero" maxlength="8" required>
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
