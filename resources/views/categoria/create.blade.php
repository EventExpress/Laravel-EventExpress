<div>
    <form action="/categoria" method="POST">
        <div>
            <label for="titulo">Categoria:</label>
            <input type="text" name="titulo" id="titulo" required>
        </div>
        <div>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
