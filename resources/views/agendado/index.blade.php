<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">
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

                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Lista de Reservas</h1>
                    <div class="mb-4">
                        <a href="/" class="underline text-sm text-gray-700 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Home</a><br><br>
                        <a href="/anuncio" class="underline text-sm text-gray-700 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Nova Reserva</a>
                    </div>
                    <br>
                    <form action="{{ url('agendado/show') }}" method="GET" class="mb-4">
                        <input type="text" name="search" placeholder="Procurar reserva" class="border rounded-md p-2">
                        <x-primary-button class="ml-3 bg-gray-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                            {{ __('buscar') }}
                         </x-primary-button>
                    </form>
                    <table border="1" class="w-full table-auto text-gray-700">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Anuncio</th>
                                <th>Endereço</th>
                                <th>Capacidade</th>
                                <th>Descricao</th>
                                <th>Locador</th>
                                <th>Data de Inicio</th>
                                <th>Data do Fim</th>
                                <th>Valor</th>
                                <th>Adicional</th>
                                <th>Cliente</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendado as $agendados)
                                <tr>
                                    <td>{{ $agendados->id }}</td>
                                    <td>{{ $agendados->anuncio->titulo }}</td>
                                    <td>{{ $agendados->anuncio->endereco->cidade }}, CEP: {{ $agendados->anuncio->endereco->cep }}, Numero: {{ $agendados->anuncio->endereco->numero }}, {{ $agendados->anuncio->endereco->bairro }}</td>
                                    <td>{{ $agendados->anuncio->capacidade }}</td>
                                    <td>{{ $agendados->anuncio->descricao }}</td>
                                    <td>{{ $agendados->anuncio->usuario->nome->nome }}</td>
                                    <td>{{ $agendados->data_inicio }}</td>
                                    <td>{{ $agendados->data_fim }}</td>
                                    <td>{{ $agendados->anuncio->valor }}</td>
                                    <td>
                                        @foreach($agendados->adicional as $adicional)
                                            {{ $adicional->titulo }} @if (!$loop->last), @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $agendados->usuario->nome->nome }}</td>
                                    <td>
                                        <a href="{{ url("agendado/$agendados->id/edit") }}" class="text-blue-500">Editar</a>
                                        <br>
                                        <form method="POST" action="{{ url("agendado/$agendados->id") }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500" onclick="return confirm('Tem certeza que deseja cancelar a reserva {{ $agendados->nome }}?')">Cancelar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($agendado->isEmpty())
                        <p>Nenhuma reserva encontrada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
