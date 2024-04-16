<div>
    <h1>Lista de Usuarios</h1>
    <div>
        <a href="/usuario/create">Cadastrar Novo usuario</a>
    </div>
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
            @foreach($usuario as $usuarios)
                <tr>
                    <td>{{$usuarios->id}}</td>
                    <td>{{$usuarios->nome}}</td>
                    <td>{{$usuarios->telefone}}</td>
                    <td>{{$usuarios->cpf}}</td>
                    <td>{{$usuarios->datanasc}}</td>
                    <td>
                        <a href="">Editar</a>
                        <br>
                        <a href="">Apagar</a>
                    </td>
                </tr>
            @endforeach
        </tbod>
    </table>
</div>
