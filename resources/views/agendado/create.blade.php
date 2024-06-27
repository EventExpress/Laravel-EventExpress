<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-500 leading-tight">
            Reservar Anúncio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 rounded-lg">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="/agendado" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="data_inicio" class="block text-sm font-medium text-orange-500">Data de Início:</label>
                            <input type="datetime-local" id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}" class="form-input mt-1 block w-full rounded-lg @error('data_inicio') is-invalid @enderror" required>
                            @error('data_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="data_fim" class="block text-sm font-medium text-orange-500">Data de Fim:</label>
                            <input type="datetime-local" id="data_fim" name="data_fim" value="{{ old('data_fim') }}" class="form-input mt-1 block w-full rounded-lg @error('data_fim') is-invalid @enderror" required>
                            @error('data_fim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="adicionalId" class="block text-sm font-medium text-orange-500">Escolher adicionais:</label>
                            <select name="adicionalId[]" id="adicionalId" class="form-multiselect mt-1 block w-full rounded-lg">
                                <option value="">Selecionar</option>
                                @foreach($adicional as $adicionais)
                                    <option value="{{ $adicionais->id }}">{{ $adicionais->titulo }} - R$ {{ $adicionais->valor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                        <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Reservar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
