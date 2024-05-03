<div>
    <form action="/adicional" method="POST">
        <div>
            <label for="titulo">Nome do adicional:</label>
            <input type="text" name="titulo" id="titulo" required>
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
            <input type="submit" value="Enviar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
