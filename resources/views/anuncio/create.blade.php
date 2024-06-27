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
                            <label for="categoriaId" class="text-orange-500">Escolher categoria</label>
                            <select name="categoriaId[]" id="categoriaId" class="block mt-1 w-full rounded-md border-gray-300">
                                @foreach($categoria as $categorias)
                                    <option value="{{ $categorias->id }}" {{ in_array($categorias->id, old('categoriaId', [])) ? 'selected' : '' }}>
                                        {{ $categorias->titulo }} - Descrição: {{ $categorias->descricao }}
                                    </option>
                                @endforeach
                            </select>
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
