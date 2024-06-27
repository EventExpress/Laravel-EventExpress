<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">
                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Meus Anúncios</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($anuncio as $anuncio)
                            <div class="bg-gray-100 rounded-md shadow-md p-4">
                                <h2 class="text-lg font-semibold">{{ $anuncio->titulo }}</h2>
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
                                    <form method="POST" action="{{ route('anuncio.destroy', $anuncio->id) }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anúncio {{ $anuncio->titulo }}?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">Excluir</button>
                                    </form>

                                    <a href="{{ route('anuncio.edit', $anuncio->id) }}" class="ml-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">Editar</a>
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
