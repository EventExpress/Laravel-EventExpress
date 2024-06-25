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

                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Anúncios</h1>


                    <form action="{{ url('anuncio/show') }}" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Procurar Anúncio" class="w-full px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <x-primary-button class="ml-3 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                            {{ __('Buscar') }}
                        </x-primary-button>
                    </form>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($anuncio as $anuncio)
                            <div class="bg-white dark:bg-gray-200 rounded-lg shadow-md p-4">
                                <p class="text-gray-900 dark:text-gray-100 font-semibold">{{ $anuncio->titulo }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $anuncio->endereco->cidade }}, CEP: {{ $anuncio->endereco->cep }}, Número: {{ $anuncio->endereco->numero }}, {{ $anuncio->endereco->bairro }}</p>
                                <p class="text-gray-700 dark:text-gray-300">Capacidade: {{ $anuncio->capacidade }}</p>
                                <p class="text-gray-700 dark:text-gray-300">{{ $anuncio->descricao }}</p>
                                <p class="text-gray-700 dark:text-gray-300">Locador: {{ $anuncio->usuario->nome->nome }}</p>
                                <p class="text-gray-700 dark:text-gray-300">Valor: {{ $anuncio->valor }}</p>

                                <div class="mt-4">
                                    @foreach($anuncio->categoria as $categoria)
                                        <span class="bg-gray-200 text-gray-700 dark:text-gray-300 px-2 py-1 text-xs rounded">{{ $categoria->titulo }}</span>
                                    @endforeach
                                </div>

                                <div class="mt-4">

                                        <a href="{{ route('anuncio.index') }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm text-blue-500 hover:text-blue-700">Reservar</a>

                                </div>
                            </div>
                        @empty
                            <p class="text-gray-700 dark:text-gray-300">Você não possui nenhum anúncio.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>