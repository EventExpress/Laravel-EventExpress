<div>
    <h1>Lista de Categorias</h1>
    <div>
        <a href="/categoria/create">Cadastrar Nova Categoria</a>
    </div>
    <br>
    <form action="{{ url('categoria/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar categoria"> 
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </thead>
        <tbod>
            @foreach($categoria as $categorias)
                <tr>
                    <td>{{$categorias->id}}</td>
                    <td>{{$categorias->nome}}</td>
                    <td>{{$categorias->descricao}}</td>
                    <td>
                        <a href="{{ url("categoria/$categorias->id/edit") }}">Editar</a>
                        <br>
                        <form method="POST" action="{{ url("categoria/$categorias->id") }}">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir a categoria {{$categorias->nome}}?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach   
        </tbod>
    </table>
</div>