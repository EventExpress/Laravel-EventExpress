<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-orange-400 dark:text-gray-800">
                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Busca de Anúncios</h1>
                    <div>
                        <a href="{{ url('/anuncio') }}" class="underline text-sm text-gray-700 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Home</a><br><br>
                    </div>

                    <form action="{{ url('anuncio/search') }}" method="GET">
                        <input type="text" name="search" placeholder="Procurar Anúncio">
                        <button type="submit">Buscar</button>
                    </form>

                    @if (isset($results) && $results->count() > 0)
                        <table border="1" class="min-w-full divide-y divide-gray-200 mt-4">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Endereço</th>
                                    <th>Capacidade</th>
                                    <th>Descrição</th>
                                    <th>Usuário</th>
                                    <th>Valor</th>
                                    <th>Agenda</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($results as $anuncio)
                                    <tr>
                                        <td>{{ $anuncio->id }}</td>
                                        <td>{{ $anuncio->titulo }}</td>
                                        <td>{{ $anuncio->endereco->cidade }}, CEP: {{ $anuncio->endereco->cep }}, Número: {{ $anuncio->endereco->numero }}, {{ $anuncio->endereco->bairro }}</td>
                                        <td>{{ $anuncio->capacidade }}</td>
                                        <td>{{ $anuncio->descricao }}</td>
                                        <td>{{ $anuncio->usuario->id }}</td>
                                        <td>{{ $anuncio->valor }}</td>
                                        <td>{{ $anuncio->agenda }}</td>
                                        <td>
                                            <a href="{{ url("anuncio/$anuncio->id/edit") }}">Editar</a>
                                            <br>
                                            <form method="POST" action="{{ url("anuncio/$anuncio->id") }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anúncio {{ $anuncio->titulo }}?')">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mt-4">Nenhum anúncio encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
