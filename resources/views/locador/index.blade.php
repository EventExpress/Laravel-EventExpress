<div>
    <h1>Lista de locadores</h1>
    <div>
        <a href="/locador/create">Cadastrar Novo locador</a>
    </div>
    <br>
    <form action="{{ url('locador/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar usuário">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
        <th>ID</th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>CPF</th>
        <th>Data Nascimento</th>
        <th>Ações</th>
        </thead>
        <tbod>
            @foreach($locador as $locadores)
                <tr>
                    <td>{{$locadores->id}}</td>
                    <td>{{$locadores->nome}}</td>
                    <td>{{$locadores->telefone}}</td>
                    <td>{{$locadores->cpf}}</td>
                    <td>{{$locadores->datanasc}}</td>
                    <td>
                        <a href="{{url("locador/$locadores->id/edit")}}">Editar</a>
                        <br>
                        <form method="POST" action="{{url("locador/$locadores->id")}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o locador {{$locadores->nome}} ?')"> Excluir</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbod>
    </table>
</div>

