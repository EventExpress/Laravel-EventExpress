<div>
    <h1>Lista de anuncios</h1>
    <div>
        <a href="/">Home</a><br><br>
    </div>

    <table border="1">
        <thead>
        <th>ID</th>
        <th>Titulo</th>
        <th>Endereço</th>
        <th>Capacidade</th>
        <th>Descrição</th>
        <th>locador</th>
        <th>Valor</th>
        <th>Categoria</th>
        <th>Ações</th>
        </thead>
        <tbody>

        @if ($anuncio->isEmpty())
            <p>Você não possui nenhum anúncio.</p>
        @else
            @foreach($anuncio as $anuncio)
                <tr>
                    <td>{{$anuncio->id}}</td>
                    <td>{{$anuncio->titulo}}</td>
                    <td>{{$anuncio->endereco->cidade}}, CEP:{{$anuncio->endereco->cep}}, Numero :{{$anuncio->endereco->numero}},{{$anuncio->endereco->bairro}}</td>
                    <td>{{$anuncio->capacidade}}</td>
                    <td>{{$anuncio->descricao}}</td>
                    <td>{{$anuncio->usuario->nome->nome}}</td>
                    <td>{{$anuncio->valor}}</td>
                    <td>
                        @foreach($anuncio->categoria as $categoria)
                            {{ $categoria->titulo }} @if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{url("anuncio/$anuncio->id/edit")}}">Editar</a>
                        <br>
                        <form method="POST" action="{{url("anuncio/$anuncio->id")}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anuncio {{$anuncio->titulo}} ?')"> Excluir</button>

                        </form>
                    </td>
                </tr>
    @endforeach
    @endif
</div>
