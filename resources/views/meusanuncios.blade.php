<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">
                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Meus Anúncios</h1>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Título</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Endereço</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Capacidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Descrição</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Locador</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Valor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Categoria</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                                @forelse($anuncio as $anuncio)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->titulo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->endereco->cidade }}, CEP: {{ $anuncio->endereco->cep }}, Número: {{ $anuncio->endereco->numero }}, {{ $anuncio->endereco->bairro }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->capacidade }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->descricao }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->usuario->nome->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $anuncio->valor }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @foreach($anuncio->categoria as $categoria)
                                                {{ $categoria->titulo }} @if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form method="POST" action="{{ route('anuncio.destroy', $anuncio->id) }}" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anúncio {{ $anuncio->titulo }}?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Excluir</button>
                                            </form>

                                            <a href="{{ route('anuncio.edit', $anuncio->id) }}" class="ml-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">Você não possui nenhum anúncio.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
