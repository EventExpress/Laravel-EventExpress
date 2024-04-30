<div>
    <form action="{{url("anuncio/create?usuario_id=$usuarios->id") }}" method="POST">
        <div>
            <label for="nome">
                Titulo:
            </label>
            <input type="text" name="titulo" id="titulo" required>
        </div>
        <div>
            <label for="categoria">
                Categoria:
            </label>
            <input type="text" name="categoria" id="categoria" required>
        </div>
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
            <input type="number" name="cep" id="cep" required>
        </div>
        <div>
            <label for="numero">
                Numero:
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
            <label for="capacidade">
                Capacidade:
            </label>
            <input type="number" name="capacidade" id="capacidade" required>
        </div>
        <div>
            <label for="descricao">
                Descrição:
            </label>
            <input type="text" name="descricao" id="descricao" required>
        </div>
        <div>
            <label for="locador">
                Locador:
            </label>
            <input type="text" name="locador" id="locador" required>
        </div>
        <div>
            <label for="valor">
                Valor:
            </label>
            <input type="number" name="valor" id="valor" required>
        </div>
        <div>
            <label for="agenda">
                Agenda:
            </label>
            <input type="date" name="agenda" id="agenda" required>
        </div>
        <div>
            <label for="status">
                Status:
            </label>
            </label>
            <select name="status" id="status" required>
                <option value="Disponivel">Disponível</option>
                <option value="Reservado">Reservado</option>
            </select>
        </div>
        <div>
        <div>
            <input type="submit" value="Enviar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>