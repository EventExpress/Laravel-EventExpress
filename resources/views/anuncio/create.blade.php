<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 block mt-1 w-full focus:border-orange-600 focus:ring-orange-500 rounded-md">
                    @if ($errors->any())
                        <div class="mb-4 font-medium text-sm text-red-600">
                            <strong>Erros:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Adicionar Anúncio</h2>
                    <form action="{{ route('anuncio.store') }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <label for="titulo" class="text-orange-500">Título:</label>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('titulo')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="cidade" class="text-orange-500">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('cidade')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="cep" class="text-orange-500">CEP:</label>
                            <input type="text" name="cep" id="cep" value="{{ old('cep') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('cep')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="numero" class="text-orange-500">Número:</label>
                            <input type="number" name="numero" id="numero" value="{{ old('numero') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('numero')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="bairro" class="text-orange-500">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('bairro')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="capacidade" class="text-orange-500">Capacidade:</label>
                            <input type="number" name="capacidade" id="capacidade" value="{{ old('capacidade') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('capacidade')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="descricao" class="text-orange-500">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" value="{{ old('descricao') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('descricao')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4 relative">
                            <label for="categoriaId" class="text-orange-500">Escolher categoria</label>
                            <div class="block mt-1 w-full rounded-md border border-gray-300 bg-white">
                            <button type="button" onclick="toggleCheckboxes()" class="w-full text-left px-4 py-2 bg-white rounded-md focus:outline-none">
                                Selecionar Categorias
                            </button>
                            </div>
                        <div id="checkboxContainer" class="hidden absolute mt-1 w-full rounded-md border border-gray-300 bg-white z-10 max-h-60 overflow-y-auto">
                        @foreach($categoria as $categorias)
                        <div class="flex items-center px-4 py-2 hover:bg-gray-100">
                            <input type="checkbox" name="categoriaId[]" id="categoria-{{ $categorias->id }}" value="{{ $categorias->id }}" class="form-checkbox h-4 w-4 text-orange-600" {{ in_array($categorias->id, old('categoriaId', [])) ? 'checked' : '' }}>
                            <label for="categoria-{{ $categorias->id }}" class="ml-2 block text-sm text-gray-900">
                                {{ $categorias->titulo }} - Descrição: {{ $categorias->descricao }}
                            </label>
                            </div>
                            @endforeach
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="valor" class="text-orange-500">Valor:</label>
                            <input type="number" name="valor" id="valor" value="{{ old('valor') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('valor')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label for="agenda" class="text-orange-500">Agenda:</label>
                            <input type="date" name="agenda" id="agenda" value="{{ old('agenda') }}" required class="block mt-1 w-full rounded-md border-gray-300">
                            @error('agenda')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <input type="submit" value="Enviar" class="px-4 py-2 bg-blue-600 text-white rounded-md">
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