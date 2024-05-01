<div>
    <h1>Lista de anuncios</h1>
    <div>
        <a href="/">Home</a><br><br>
    </div>

    <form action="{{ url('anuncio/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar Anuncio">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
        <th>ID</th>
        <th>Titulo</th>
        <th>Categoria</th>
        <th>Endereço</th>
        <th>Descrição</th>
        <th>locador</th>
        <th>Valor</th>
        <th>Agenda</th>
        <th>Ações</th>
        </thead>
        <tbody>
        @foreach($anuncio as $anuncios)
            <tr>
                <td>{{$anuncios->id}}</td>
                <td>{{$anuncios->titulo}}</td>
                <td>{{$anuncios->endereco->cidade}}, CEP:{{$anuncios->endereco->cep}}, Numero :{{$anuncios->endereco->numero}},{{$anuncios->endereco->bairro}}</td>
                <td>{{$anuncios->capacidade}}</td>
                <td>{{$anuncios->descricao}}</td>
                <td>{{$anuncios->usuario->nome->nome}}</td>
                <td>{{$anuncios->valor}}</td>
                <td>{{$anuncios->agenda}}</td>
                <td>
                    <a href="{{url("anuncio/$anuncios->id/edit")}}">Editar</a>
                    <br>
                    <form method="POST" action="{{url("anuncio/$anuncios->id")}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anuncio {{$anuncios->titulo}} ?')"> Excluir</button>

                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>
