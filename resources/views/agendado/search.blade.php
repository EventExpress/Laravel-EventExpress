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

                    <form action="{{ url('agendado/show') }}" method="GET" class="mb-4">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Procurar reserva" class="border rounded-l-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <x-primary-button class="ml-3 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                                {{ __('Buscar') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @if ($agendado->count() > 0)
                        @foreach($agendado as $agendados)
                            <div class="mb-4 p-4 border rounded-md bg-white dark:bg-gray-700">
                                <p><strong>Anúncio:</strong> {{ $agendados->anuncio->titulo }}</p>
                                <p><strong>Endereço:</strong> {{ $agendados->anuncio->endereco->cidade }}, CEP: {{ $agendados->anuncio->endereco->cep }}, Número: {{ $agendados->anuncio->endereco->numero }}, {{ $agendados->anuncio->endereco->bairro }}</p>
                                <p><strong>Capacidade:</strong> {{ $agendados->anuncio->capacidade }}</p>
                                <p><strong>Descrição:</strong> {{ $agendados->anuncio->descricao }}</p>
                                <p><strong>Locador:</strong> {{ $agendados->anuncio->usuario->nome->nome }}</p>
                                <p><strong>Data de Início:</strong> {{ $agendados->data_inicio }}</p>
                                <p><strong>Data do Fim:</strong> {{ $agendados->data_fim }}</p>
                                <p><strong>Valor:</strong> {{ $agendados->anuncio->valor }}</p>
                                <div class="mt-2">
                                    <a href="{{ url("agendado/$agendados->id/edit") }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600">Editar</a>
                                    <form method="POST" action="{{ url("agendado/$agendados->id") }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja cancelar a reserva {{$agendados->nome}}?')" class="inline-block bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="mt-4">Nenhuma reserva encontrada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
