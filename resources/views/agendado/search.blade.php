<div>
    <h1>Lista de Reservas</h1>
    <div>
        <a href="/anuncio/create">Fazer uma nova reserva</a>
    </div>
    <br>
    <form action="{{ url('agendado/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar reserva"> 
        <button type="submit">Search</button>
    </form>
    @if ($results->count() > 0)
        <table border="1">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Anuncio</th>
                <th>Agenda</th>
                <th>Valor</th>
                <th>Descricao</th>
                <th>Adicional</th>
                <th>Status</th>
                <th>Ações</th>
            </thead>
            <tbod>
                @foreach($agendado as $agendados)
                    <tr>
                        <td>{{$agendados->id}}</td>
                        <td>{{$agendados->nome->nome}}</td>
                        <td>{{$agendados->anuncio->nome}}</td>
                        <td>{{$agendados->anuncio->agenda}}</td>
                        <td>{{$agendados->anuncio->valor}}</td>
                        <td>{{$agendados->anuncio->descricao}}</td>
                        <td>{{$agendados->adicional->nome}}</td>
                        <td>{{$agendados->status}}</td>
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
    @else
    <p>Nenhuma reserva encontrada.</p>
    @endif
</div>
