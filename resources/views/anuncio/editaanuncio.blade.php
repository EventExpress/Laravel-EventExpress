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
                            <label for="titulo" class="block text-sm font-medium text-orange-500">Título:</label>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $anuncio->titulo) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('titulo')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cidade" class="block text-sm font-medium text-orange-500">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $anuncio->endereco->cidade) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('cidade')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cep" class="block text-sm font-medium text-orange-500">CEP:</label>
                            <input type="text" name="cep" id="cep" value="{{ old('cep', $anuncio->endereco->cep) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('cep')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="numero" class="block text-sm font-medium text-orange-500">Número:</label>
                            <input type="number" name="numero" id="numero" value="{{ old('numero', $anuncio->endereco->numero) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('numero')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bairro" class="block text-sm font-medium text-orange-500">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $anuncio->endereco->bairro) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('bairro')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4 relative">
                            <label for="categoriaId" class="block text-sm font-medium text-orange-500">Trocar categoria:</label>
                            <div class="block w-full mt-1 rounded-lg border border-gray-500 bg-white">
                                <button type="button" onclick="toggleCheckboxes()" class="w-full text-left px-4 py-2 bg-white rounded-lg focus:outline-none">
                                    Selecionar Categorias
                                </button>
                            </div>
                            <div id="checkboxContainer" class="hidden absolute mt-1 w-full rounded-lg border border-gray-300 bg-white z-10 max-h-60 overflow-y-auto">
                                @foreach($categoria as $categoria)
                            <div class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <input type="checkbox" name="categoriaId[]" id="categoria-{{ $categoria->id }}" value="{{ $categoria->id }}" class="form-checkbox h-4 w-4 text-orange-600" @if(in_array($categoria->id, $categoriaSelecionada)) checked @endif>
                                <label for="categoria-{{ $categoria->id }}" class="ml-2 block text-sm text-gray-900">
                                {{ $categoria->titulo }} - Descrição: {{ $categoria->descricao }}
                            </label>
                            </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="capacidade" class="block text-sm font-medium text-orange-500">Capacidade:</label>
                            <input type="number" name="capacidade" id="capacidade" value="{{ old('capacidade', $anuncio->capacidade) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('capacidade')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descricao" class="block text-sm font-medium text-orange-500">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" value="{{ old('descricao', $anuncio->descricao) }}" class="form-input mt-1 block w-full rounded-lg" required>
                            @error('descricao')
                                <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                            @enderror
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
<script>
    function toggleCheckboxes() {
        var container = document.getElementById('checkboxContainer');
        if (container.classList.contains('hidden')) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    // Hide the dropdown if user clicks outside of it
    document.addEventListener('click', function(event) {
        var container = document.getElementById('checkboxContainer');
        var button = container.previousElementSibling.querySelector('button');
        if (!container.contains(event.target) && !button.contains(event.target)) {
            container.classList.add('hidden');
        }
    });
</script>
