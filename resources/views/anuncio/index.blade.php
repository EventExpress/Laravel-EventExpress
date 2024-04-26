<div>
    <h1>Lista de anuncios</h1>
    <div>
        <a href="/anuncio/create">Cadastrar Anuncio</a>
    </div>
    <br>
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
        <th>Capacidade</th>
        <th>Descrição</th>
        <th>Locador</th>
        <th>Valor</th>
        <th>Agenda</th>
        <th>Status</th>
        <th>Ações</th>
        </thead>
        <tbod>
            @foreach($anuncio as $anuncios)
                <tr>
                    <td>{{$anuncios->id}}</td>
                    <td>{{$anuncios->titulo}}</td>
                    <td>{{$anuncios->categoria}}</td>
                    <td>{{$anuncios->endereco}}</td>
                    <td>{{$anuncios->capacidade}}</td>
                    <td>{{$anuncios->descricao}}</td>
                    <td>{{$anuncios->locador}}</td>
                    <td>{{$anuncios->valor}}</td>
                    <td>{{$anuncios->agenda}}</td>
                    <td>{{$anuncios->status}}</td>
                    <td>
                        <a href="{{url("anuncio/$anuncios->id/edit")}}">Editar</a>
                        <br>
                        <form method="POST" action="{{url("anuncio/$anuncios->id")}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anuncio {{$anuncios->nome}} ?')"> Excluir</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbod>
    </table>
</div>