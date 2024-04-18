<div>
    <h1>Busca</h1>
    <div>
        <a href="/usuario/create">Cadastrar Novo usuario</a>
        <br>
        <br>
        <button><a href="/usuario">Home</a></button>
    </div>
    <br>
    <form action="{{ url('usuario/search') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar usuário">
        <button type="submit">Search</button>
    </form>

    @if ($results->count() > 0)
        <table border="1">
            <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Data Nascimento</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @foreach ($results as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->telefone }}</td>
                    <td>{{ $usuario->cpf }}</td>
                    <td>{{ $usuario->datanasc }}</td>
                    <td>
                        <a href="{{ url("usuario/$usuario->id/edit") }}">Editar</a>
                        <br>
                        <form method="POST" action="{{ url("usuario/$usuario->id") }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o usuário {{ $usuario->nome }}?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum usuário encontrado.</p>
    @endif
</div>
