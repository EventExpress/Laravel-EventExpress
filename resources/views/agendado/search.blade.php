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

                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Busca de Reservas</h1>

                    <div class="mb-4">
                        <a href="{{ route('anuncio.create') }}" class="underline text-sm text-gray-700 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Nova reserva</a>
                        <br><br>
                        <a href="/agendado" class="btn btn-primary">Home</a>
                    </div>

                    <form action="{{ url('agendado/show') }}" method="GET">
                        <div class="flex mb-4">
                            <input type="text" name="search" placeholder="Procurar reserva" class="form-control">
                            <x-primary-button class="ml-3">
                                {{ __('Buscar') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @if ($agendado->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th>ID</th>
                                    <th>Anúncio</th>
                                    <th>Endereço</th>
                                    <th>Capacidade</th>
                                    <th>Descrição</th>
                                    <th>Locador</th>
                                    <th>Data de Início</th>
                                    <th>Data do Fim</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-700 text-gray-700">
                                @foreach($agendado as $agendados)
                                    <tr>
                                        <td>{{ $agendados->id }}</td>
                                        <td>{{ $agendados->anuncio->titulo }}</td>
                                        <td>{{ $agendados->anuncio->endereco->cidade }}, CEP: {{ $agendados->anuncio->endereco->cep }}, Número: {{ $agendados->anuncio->endereco->numero }}, {{ $agendados->anuncio->endereco->bairro }}</td>
                                        <td>{{ $agendados->anuncio->capacidade }}</td>
                                        <td>{{ $agendados->anuncio->descricao }}</td>
                                        <td>{{ $agendados->anuncio->usuario->nome->nome }}</td>
                                        <td>{{ $agendados->data_inicio }}</td>
                                        <td>{{ $agendados->data_fim }}</td>
                                        <td>{{ $agendados->anuncio->valor }}</td>
                                        <td>
                                            <a href="{{ url("agendado/$agendados->id/edit") }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                            <form method="POST" action="{{ url("agendado/$agendados->id") }}" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Tem certeza que deseja cancelar a reserva {{$agendados->nome}}?')" class="text-red-600 hover:text-red-900">Cancelar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Nenhuma reserva encontrada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
