<div>
    <form action="{{ url("/categoria/$categoria->id") }}" method="POST">
        @method("PUT")
        <h1>Editar Categoria</h1>
        <div>
            <label>
                <span>Categoria:</span>
                <input type="text" name="titulo" id="titulo" value="{{$categoria->titulo}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Descrição:</span>
                <input type="text" name="descricao" id="descricao" value="{{$categoria->descricao}}" required>
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>