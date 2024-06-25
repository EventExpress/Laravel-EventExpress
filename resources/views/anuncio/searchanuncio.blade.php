<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
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
                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Lista de Anúncios</h1>
                    <div>

                        <form action="{{ url('anuncio/show') }}" method="GET" class="mb-4 flex">
                            <input type="text" name="search" placeholder="Procurar Anúncio" class="w-full px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <x-primary-button class="ml-3 bg-orange-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                                {{ __('Buscar') }}
                            </x-primary-button>
                        </form>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 text-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Endereço</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacidade</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locador</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                                    @foreach($results as $anuncios)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->titulo }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->endereco->cidade }}, CEP: {{ $anuncios->endereco->cep }}, Número: {{ $anuncios->endereco->numero }}, {{ $anuncios->endereco->bairro }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->capacidade }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->descricao }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->usuario->nome->nome }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $anuncios->valor }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @foreach($anuncios->categoria as $categoria)
                                                    {{ $categoria->titulo }} @if (!$loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if(Auth::check() && Auth::user()->tipousu != 'Locador')
                                                    <a href="{{ route('agendado.create', ['anuncioId' => $anuncios->id]) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm text-blue-500 hover:text-blue-700">Reservar</a>
                                                    @error('agendado')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                                @if(Auth::check() && Auth::user()->tipousu == 'Locador')
                                                    <div class="mt-2">
                                                        <a href="{{ route('anuncio.edit', ['id' => $anuncios->id]) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Editar</a>
                                                        <form method="POST" action="{{ route('anuncio.destroy', ['id' => $anuncios->id]) }}" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir o anúncio {{ $anuncios->titulo }}?')" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Excluir</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
