@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div>

    <h1>Lista de anuncios</h1>
    <div>
        <a href="/">Home</a><br><br>
    </div>

    <form action="{{ url('anuncio/show') }}" method="GET">
        <input type="text" name="search" placeholder="Procurar Anuncio">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <thead>
        <th>ID</th>
        <th>Titulo</th>
        <th>Endereço</th>
        <th>Capacidade</th>
        <th>Descrição</th>
        <th>locador</th>
        <th>Valor</th>
        <th>Categoria</th>
        <th>Ações</th>
        </thead>
        <tbody>
        @foreach($anuncio as $anuncios)
            <tr>
                <td>{{$anuncios->id}}</td>
                <td>{{$anuncios->titulo}}</td>
                <td>{{$anuncios->endereco->cidade}}, CEP:{{$anuncios->endereco->cep}}, Numero :{{$anuncios->endereco->numero}},{{$anuncios->endereco->bairro}}</td>
                <td>{{$anuncios->capacidade}}</td>
                <td>{{$anuncios->descricao}}</td>
                <td>{{$anuncios->usuario->nome->nome}}</td>
                <td>{{$anuncios->valor}}</td>
                <td>
                        @foreach($anuncios->categoria as $categoria)
                            {{ $categoria->titulo }} @if (!$loop->last), @endif
                        @endforeach
                    </td>
                <td>
                    <br>
                        <a href="{{ route('agendado.create', ['anuncioId' => $anuncios->id]) }}">Reservar</a>

                    @error('agendado')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        @endforeach

        </tbody>

    </table>
</div>
