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

                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Busca de Anúncios</h1>



                    @if ($results->isEmpty())
                        <p class="text-gray-700 dark:text-gray-300">Nenhum anúncio encontrado.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($results as $anuncios)
                                <div class="bg-white dark:bg-gray-200 rounded-lg shadow-md p-4">
                                    <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ $anuncios->titulo }}</p>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $anuncios->endereco->cidade }}, CEP: {{ $anuncios->endereco->cep }}, Número: {{ $anuncios->endereco->numero }}, {{ $anuncios->endereco->bairro }}</p>
                                    <p class="text-gray-700 dark:text-gray-300">Capacidade: {{ $anuncios->capacidade }}</p>
                                    <p class="text-gray-700 dark:text-gray-300">{{ $anuncios->descricao }}</p>
                                    <p class="text-gray-700 dark:text-gray-300">Locador: {{ $anuncios->usuario->nome->nome }}</p>
                                    <p class="text-gray-700 dark:text-gray-300">Valor: {{ $anuncios->valor }}</p>

                                    <div class="mt-4">
                                        @foreach($anuncios->categoria as $categoria)
                                            <span class="bg-gray-200 text-gray-700 dark:text-gray-300 px-2 py-1 text-xs rounded">{{ $categoria->titulo }}</span>
                                        @endforeach
                                    </div>

                                    <div class="mt-4">
                                            <a href="{{ route('agendado.create', ['anuncioId' => $anuncios->id]) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm text-blue-500 hover:text-blue-700">Reservar</a>

                                        @error('agendado')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
