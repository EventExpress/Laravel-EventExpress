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
                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Lista de Anúncios</h1>
                    <div>
                        <div>
                            <a href="/"class="underline text-sm text-gray-700 hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Home</a><br><br>
                        </div>

                        <form action="{{ url('anuncio/show') }}" method="GET">
                            <input type="text" name="search" placeholder="Procurar Anúncio">
                            <x-primary-button class="ml-3 bg-gray-500 hover:bg-orange-600 focus:bg-orange-600 focus:ring-orange-500">
                {{ __('buscar') }}
            </x-primary-button>
                        </form>
                        
                        <table border="1" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 text-gray-700">
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Endereço</th>
                                    <th>Capacidade</th>
                                    <th>Descrição</th>
                                    <th>Locador</th>
                                    <th>Valor</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-700 text-gray-700">
                                @foreach($anuncio as $anuncios)
                                    <tr>
                                        <td>{{ $anuncios->id }}</td>
                                        <td>{{ $anuncios->titulo }}</td>
                                        <td>{{ $anuncios->endereco->cidade }}, CEP: {{ $anuncios->endereco->cep }}, Número: {{ $anuncios->endereco->numero }}, {{ $anuncios->endereco->bairro }}</td>
                                        <td>{{ $anuncios->capacidade }}</td>
                                        <td>{{ $anuncios->descricao }}</td>
                                        <td>{{ $anuncios->usuario->nome->nome }}</td>
                                        <td>{{ $anuncios->valor }}</td>
                                        <td>
                                            @foreach($anuncios->categoria as $categoria)
                                                {{ $categoria->titulo }} @if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <br>
                                            <a href="{{ route('agendado.create', ['anuncioId' => $anuncios->id]) }}">Reservar</a>
                                            @error('agendado')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
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
</x-app-layout>
