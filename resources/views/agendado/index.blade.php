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

                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Reservas</h1>

                    <form action="{{ url('agendado/show') }}" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Procurar reserva" class="border rounded-l-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <x-primary-button class="ml-3 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                            {{ __('buscar') }}
                        </x-primary-button>
                    </form>

                    @forelse ($agendado as $agendados)
                        <div class="bg-gray-100 rounded-md p-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <h2 class="text-lg font-semibold">{{ $agendados->anuncio->titulo }}</h2>
                                    <p>{{ $agendados->anuncio->descricao }}</p>
                                </div>
                                <div class="md:text-right">
                                    <p><span class="font-semibold">Anunciante:</span> {{ $agendados->anuncio->usuario->nome->nome }}</p>
                                    <p><span class="font-semibold">Data de Início:</span> {{ $agendados->data_inicio }}</p>
                                    <p><span class="font-semibold">Data do Fim:</span> {{ $agendados->data_fim }}</p>
                                    <p><span class="font-semibold">Valor:</span> {{ $agendados->anuncio->valor }}</p>
                                    <p><span class="font-semibold">Adicionais:</span>
                                        @foreach($agendados->adicional as $adicional)
                                            {{ $adicional->titulo }} @if (!$loop->last), @endif
                                        @endforeach
                                    </p>
                                    <p><span class="font-semibold">Cliente:</span> {{ $agendados->usuario->nome->nome }}</p>
                                </div>
                                <div class="col-span-3 md:col-span-1 mt-4 md:mt-0">
                                    <p><span class="font-semibold">Endereço:</span><br>
                                        {{ $agendados->anuncio->endereco->cidade }}, CEP: {{ $agendados->anuncio->endereco->cep }}, Número: {{ $agendados->anuncio->endereco->numero }}, {{ $agendados->anuncio->endereco->bairro }}
                                    </p>
                                    <p><span class="font-semibold">Capacidade:</span> {{ $agendados->anuncio->capacidade }}</p>

                                    <div class="">
                                        <a href="{{ url("agendado/$agendados->id/edit") }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm">Editar</a>
                                        <form method="POST" action="{{ url("agendado/$agendados->id") }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-block bg-red-500 text-white px-3 py-1 rounded-md text-sm" onclick="return confirm('Tem certeza que deseja cancelar a reserva {{ $agendados->nome }}?')">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="mt-4">Nenhuma reserva encontrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
