<div>
    <h1>Lista de enderecos</h1>
    <div>
        <a href="/">Home</a><br><br>
        <a href="/endereco/create">Cadastrar Endereço</a>
    </div>
    <br>
    <form action="{{ url('endereco/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar Endereço">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
        <th>ID</th>
        <th>Cidade</th>
        <th>cep</th>
        <th>numero</th>
        <th>Bairro</th>
        <th>Ações</th>
        </thead>
        <tbod>
            @foreach($endereco as $enderecos)
                <tr>
                    <td>{{$enderecos->id}}</td>
                    <td>{{$enderecos->cidade}}</td>
                    <td>{{$enderecos->cep}}</td>
                    <td>{{$enderecos->numero}}</td>
                    <td>{{$enderecos->bairro}}</td>
                    <td>
                        <a href="{{url("endereco/$enderecos->id/edit")}}">Editar</a>
                        <br>
                        <form method="POST" action="{{url("endereco/$enderecos->id")}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o endereco {{$enderecos->nome}} ?')"> Excluir</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbod>
    </table>
</div>
