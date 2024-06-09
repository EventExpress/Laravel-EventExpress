<div>
    <h1>Busca de Categorias</h1>
    <div>
        <a href="/categoria/create">Cadastrar Nova Categoria</a>
        <br>
        <br>
        <button><a href="/categoria">Home</a></button>
    </div>
    <br>
    <form action="{{ url('categoria/search') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar categoria"> 
        <button type="submit">Search</button>
    </form>

    @if ($categoria->count() > 0)
        <table border="1">
            <thead>
                <th>ID</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Ações</th>
            </thead>
            <tbod>
                @foreach($categoria as $categorias)
                    <tr>
                        <td>{{$categorias->id}}</td>
                        <td>{{$categorias->titulo}}</td>
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
    @else
        <p>Nenhuma categoria encontrada.</p>
    @endif
</div>