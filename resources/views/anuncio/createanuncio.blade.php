<div>
    <form action="/endereco" method="POST">
        <div>
            <label for="nome">
                titulo:
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
            <label for="endereco">
                Endereço:
            </label>
            <input type="text" name="endereco" id="endereco" required>
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
            <input type="text" name="agenda" id="agenda" required>
        </div>
        <div>
            <label for="status">
                Status:
            </label>
            </label>
            <select name="status" id="status" required>
                <option value="pago">Pago</option>
                <option value="processando">Processando</option>
                <option value="cancelado">Cancelado</option>
                <option value="pendente">Pendente</option>
            </select>
        </div>
        <div>
        <div>
            <input type="submit" value="Enviar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>

