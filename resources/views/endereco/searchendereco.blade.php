<div>
    <h1>Busca</h1>
    <div>
        <a href="{{ url('/endereco/create') }}">Cadastrar Novo endereco</a>
        <br><br>
        <a href="{{ url('/endereco') }}">Home</a>
    </div>
    <br>
    <form action="{{ url('endereco/search') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar endereco">
        <button type="submit">Search</button>
    </form>

    @if ($results->count() > 0)
        <table border="1">
            <thead>
            <tr>
                <th>ID</th>
                <th>Cidade</th>
                <th>Cep</th>
                <th>numero</th>
                <th>Bairro</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $endereco)
                <tr>
                    <td>{{ $endereco->id }}</td>
                    <td>{{ $endereco->cidade }}</td>
                    <td>{{ $endereco->cep }}</td>
                    <td>{{ $endereco->numero }}</td>
                    <td>{{ $endereco->bairro }}</td>
                    <td>
                        <a href="{{ url("endereco/$endereco->id/edit") }}">Editar</a>
                        <br>
                        <form method="POST" action="{{ url("endereco/$endereco->id") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o endereco {{ $endereco->cidade }} ?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum endereco encontrado.</p>
    @endif
</div>