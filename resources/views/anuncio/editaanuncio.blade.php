<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Anúncio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800 rounded-lg">
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

                    <h1 class="text-2xl font-semibold mb-4 text-orange-500">Editar Anúncio</h1>

                    <form action="{{ route('anuncio.update', $anuncio->id) }}" method="POST">
                        @csrf
                        @method("PUT")

                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título:</label>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $anuncio->titulo) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('titulo')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $anuncio->endereco->cidade) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('cidade')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP:</label>
                            <input type="text" name="cep" id="cep" value="{{ old('cep', $anuncio->endereco->cep) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('cep')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="numero" class="block text-sm font-medium text-gray-700">Número:</label>
                            <input type="number" name="numero" id="numero" value="{{ old('numero', $anuncio->endereco->numero) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('numero')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $anuncio->endereco->bairro) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('bairro')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="capacidade" class="block text-sm font-medium text-gray-700">Capacidade:</label>
                            <input type="number" name="capacidade" id="capacidade" value="{{ old('capacidade', $anuncio->capacidade) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('capacidade')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" value="{{ old('descricao', $anuncio->descricao) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('descricao')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="categoriaId" class="block text-sm font-medium text-gray-700">Trocar categoria:</label>
                            <select name="categoriaId[]" id="categoriaId" class="form-multiselect block w-full mt-1 rounded-lg" multiple>
                                @foreach($categoria as $categoria)
                                    <option value="{{ $categoria->id }}" @if(in_array($categoria->id, $categoriaSelecionada)) selected @endif>{{ $categoria->titulo }} - Descrição: {{ $categoria->descricao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                                Editar Anúncio
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
