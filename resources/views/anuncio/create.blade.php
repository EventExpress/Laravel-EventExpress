<div>
    <h2>Adicionar Anúncio</h2>
    <form action="/anuncio" method="POST">
        @csrf
        <div>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>
        </div>
        <div>
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" required>
        </div>
        <div>
            <label for="cep">CEP:</label>
            <input type="number" name="cep" id="cep" required>
        </div>
        <div>
            <label for="numero">Número:</label>
            <input type="number" name="numero" id="numero" required>
        </div>
        <div>
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" required>
        </div>
        <div>
            <label for="capacidade">Capacidade:</label>
            <input type="number" name="capacidade" id="capacidade" required>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>
        </div>
        <div>
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" required>
        </div>
        <div>
            <label for="agenda">Agenda:</label>
            <input type="date" name="agenda" id="agenda" required>
        </div>
        <div>
            <label for="categoriaId">Selecione uma categoria:</label>
            <select id="categoriaId" name="categoriaId">
                <option value="1">Infantil</option>
                <option value="2">Categoria 2</option>
                <option value="3">Categoria 3</option>
            </select>
        </div>
        <div>
            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
            <input type="submit" value="Enviar">
        </div>
    </form>
</div>

