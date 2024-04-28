<div>
    <form action="/adicional" method="POST">
        <div>
            <label for="titulo">Nome do adicional:</label>
            <input type="text" name="titulo" id="titulo" required>
        </div>
        <div>
            <label>
                <span>Categoria:</span>
                <input type="text" name="categoria" id="categoria" value="{{$adicional->categoria->nome}}" readonly>
            </label>   
        </div>
        <div>
            <label>
                <span>Descrição:</span>
                <input type="text" name="descricao" id="descricao" value="{{$adicional->descricao}}" readonly>
            </label>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>
        </div>
        <div>
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" required>
        </div>
        <div>
            <label for="disponibilidade">Disponibilidade:</label>
            <input type="text" name="disponibilidade" id="disponibilidade" required>
        </div>
        <div>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Pago">Pago</option>
                <option value="Processando">Processando</option>
                <option value="Cancelado">Cancelado</option>
                <option value="Pendente">Pendente</option>
                <option value="Disponivel">Disponível</option>
                <option value="Reservado">Reservado</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
