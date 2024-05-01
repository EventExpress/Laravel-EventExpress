<div>
    <h1>Busca</h1>
    <div>
        <a href="{{ url('/anuncio') }}">Home</a>
    </div>
    <br>
    <form action="{{ url('anuncio/search') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar anuncio">
        <button type="submit">Search</button>
    </form>

    @if ($results->count() > 0)
        <table border="1">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Endereço</th>
                <th>Capacidade</th>
                <th>Descrição</th>
                <th>Usuário</th>
                <th>Valor</th>
                <th>Agenda</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $anuncio)
                <tr>
                    <td>{{ $anuncio->id }}</td>
                    <td>{{ $anuncio->titulo }}</td>
                    <td>{{$anuncios->endereco->cidade}}, CEP:{{$anuncios->endereco->cep}}, Numero :{{$anuncios->endereco->numero}},{{$anuncios->endereco->bairro}}</td>
                    <td>{{ $anuncio->capacidade }}</td>
                    <td>{{ $anuncio->descricao }}</td>
                    <td>{{ $anuncio->usuario->id }}</td>
                    <td>{{ $anuncio->valor }}</td>
                    <td>{{ $anuncio->agenda }}</td>
                    <td>
                        <a href="{{ url("anuncio/$anuncio->id/edit") }}">Editar</a>
                        <br>
                        <form method="POST" action="{{ url("anuncio/$anuncio->id") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anuncio {{ $anuncio->titulo }} ?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum anuncio encontrado.</p>
    @endif
</div>