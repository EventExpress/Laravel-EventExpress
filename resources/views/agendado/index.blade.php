<div>
    <h1>Lista de Reservas</h1>
    <div>
        <a href="/">Home</a><br><br>
        <a href="/anuncio">Nova Reserva</a>
    </div>
    <br>
    <form action="{{ url('agendado/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar reserva">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
            <th>ID</th>
            <th>Anuncio</th>
            <th>Endereço</th>
            <th>Capacidade</th>
            <th>Descricao</th>
            <th>Locador</th>
            <th>Data de Inicio</th>
            <th>Data do Fim</th>
            <th>Valor</th>
            <th>Adicional</th>
            <th>Cliente</th>
            <th>Ações</th>
        </thead>
        <tbod>
            @foreach($agendado as $agendados)
                <tr>
                    <td>{{$agendados->id}}</td>
                    <td>{{$agendados->anuncio->titulo}}</td>
                    <td>{{$agendados->anuncio->endereco->cidade}}, CEP:{{$agendados->anuncio->endereco->cep}}, Numero :{{$agendados->anuncio->endereco->numero}},{{$agendados->anuncio->endereco->bairro}}</td>
                    <td>{{$agendados->anuncio->capacidade}}</td>
                    <td>{{$agendados->anuncio->descricao}}</td>
                    <td>{{$agendados->anuncio->usuario->nome->nome}}</td>
                    <td>{{$agendados->data_inicio}}</td>
                    <td>{{$agendados->data_fim}}</td>
                    <td>{{$agendados->anuncio->valor}}</td>
                    <td>
                        @foreach($agendados->adicional as $adicional)
                            {{ $adicional->titulo }} @if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $agendados->usuario->nome->nome }}</td>
                    <td>
                        <a href="{{ url("agendado/$agendados->id/edit") }}">Editar</a>
                        <br>
                        <form method="POST" action="{{ url("agendado/$agendados->id") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja cancelar a reserva {{$agendados->nome}}?')">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbod>
    </table>
</div>
