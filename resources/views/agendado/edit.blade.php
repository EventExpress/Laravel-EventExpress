<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-orange-500">
            Editar Reserva
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 rounded-lg">
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

                    <form method="POST" action="{{ route('agendado.update', $agendado->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="data_inicio" class="block text-sm font-medium text-orange-500">Data de Início:</label>
                            <input type="datetime-local" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $agendado->data_inicio) }}" class="form-input mt-1 block w-full rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="data_fim" class="block text-sm font-medium text-orange-500">Data de Fim:</label>
                            <input type="datetime-local" id="data_fim" name="data_fim" value="{{ old('data_fim', $agendado->data_fim) }}" class="form-input mt-1 block w-full rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="adicionalId" class="block text-sm font-medium text-orange-500">Escolher adicional:</label>
                            <select name="adicionalId[]" id="adicionalId" multiple class="form-multiselect mt-1 block w-full rounded-lg">
                                <option value="">Nenhum adicional</option>
                                @foreach($adicional as $adicionais)
                                    <option value="{{ $adicionais->id }}" {{ in_array($adicionais->id, $adicionaisSelecionados) ? 'selected' : '' }}>{{ $adicionais->titulo }} - R$ {{ $adicionais->valor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-gray-700 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
