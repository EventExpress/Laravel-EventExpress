<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
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
                        <a href="/agendado" class="underline text-sm text-gray-700 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Home</a>
                    </div>

                    <form action="{{ url('agendado/show') }}" method="GET" class="mb-4">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Procurar reserva" class="border rounded-l-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <x-primary-button class="ml-3 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                                {{ __('Buscar') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @if ($agendado->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 text-gray-700">
                                    <tr>
                                     <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th> -->
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anúncio</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacidade</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locador</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Início</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data do Fim</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                                    @foreach($agendado as $agendados)
                                        <tr>
                                           <!-- <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->id }}</td> -->
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->anuncio->titulo }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->anuncio->endereco->cidade }}, CEP: {{ $agendados->anuncio->endereco->cep }}, Número: {{ $agendados->anuncio->endereco->numero }}, {{ $agendados->anuncio->endereco->bairro }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->anuncio->capacidade }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->anuncio->descricao }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->anuncio->usuario->nome->nome }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->data_inicio }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->data_fim }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $agendados->anuncio->valor }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ url("agendado/$agendados->id/edit") }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm text-blue-600 hover:text-blue-900">Editar</a>
                                                <form method="POST" action="{{ url("agendado/$agendados->id") }}" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Tem certeza que deseja cancelar a reserva {{$agendados->nome}}?')" class="inline-block bg-red-500 text-white px-3 py-1 rounded-md text-sm text-red-600 hover:text-red-900">Cancelar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mt-4">Nenhuma reserva encontrada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
