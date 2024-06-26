<div>
    <h1>Lista de Adicionais</h1>
    <div>
        <a href="/adicional/create">Cadastrar Novo Adicional</a>
        <br>
        <br>
        <button><a href="/adicional">Home</a></button>
    </div>
    <br>
    <form action="{{ url('adicional/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar adicional"> 
        <button type="submit">Search</button>
    </form>
    
    @if ($adicional->count() > 0)
        <table border="1">
            <thead>
            <th>ID</th>
            <th>Nome do adicional</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Ações</th>
            </thead>
            <tbod>
                @foreach($adicional as $adicionais)
                    <tr>
                        <td>{{$adicionais->id}}</td>
                        <td>{{$adicionais->titulo}}</td>
                        <td>{{$adicionais->descricao}}</td>
                        <td>{{$adicionais->valor}}</td>
                        <td>
                            <a href="{{ url("adicional/$adicionais->id/edit") }}">Editar</a>
                            <br>
                            <form method="POST" action="{{ url("adicional/$adicionais->id") }}">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o adicional {{$adicionais->nome_adicional}}?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach  
            </tbod>
        </table>
    @else
        <p>Nenhum adicional encontrado.</p>
    @endif
</div>
