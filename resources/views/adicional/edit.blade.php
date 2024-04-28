<div>
    <form action="{{ url("/adicional/$adicional->id") }}" method="POST">
        @method("PUT")
        <h1>Editar Adicional</h1>
        <div>
            <label>
                <span>Nome:</span>
                <input type="text" name="titulo" id="titulo" value="{{$adicional->titulo}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Anuncio:</span>
                <input type="text" name="anuncio" id="anuncio" value="{{$adicional->anuncio->nome}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Categoria:</span>
                <input type="text" name="categoria" id="categoria" value="{{$adicional->categoria->nome}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Descrição:</span>
                <input type="text" name="descricao" id="descricao" value="{{$adicional->descricao}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Valor:</span>
                <input type="text" name="valor" id="valor" value="{{$adicional->valor}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Disponibilidade:</span>
                <input type="text" name="disponibilidade" id="disponibilidade" value="{{$adicional->disponibilidade}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Status:</span>
                <input type="text" name="status" id="status" value="{{$adicional->status}}" required>
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>