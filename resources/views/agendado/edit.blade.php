<div>
    <form action="{{ url("/agendado/$agendado->id") }}" method="POST">
        @method("PUT")
        <h1>Editar Reserva</h1>
        <div>
            <label>
                <span>Nome:</span>
                <input type="text" name="nome" id="nome" value="{{$agendado->nome->nome}}" readonly>
            </label>
        </div>
        <div>
            <label>
                <span>Anuncio:</span>
                <input type="text" name="nome" id="nome" value="{{$agendado->anuncio->nome}}" readonly>
            </label>
        </div>
        <div>
            <label>
                <span>Agenda:</span>
                <input type="date" name="agenda" id="agenda" value="{{$agendado->anuncio->agenda}}" readonly>
            </label>
        </div>
        <div>
            <label>
                <span>Valor:</span>
                <input type="number" name="valor" id="valor" value="{{$agendado->anuncio->valor}}" required>
            </label>
        </div>
        <div>
            <label>
                <span>Descrição:</span>
                <input type="text" name="descricao" id="descricao" value="{{$agendado->anuncio->descricao}}" readonly>
            </label>
        </div>
        <div>
            <label>
                <span>Adicional:</span>
                <input type="text" name="adicional" id="adicional" value="{{$agendado->adicional}}" required>
            </label>
        </div>
        <div>
            <input type="submit" value="Editar">
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>