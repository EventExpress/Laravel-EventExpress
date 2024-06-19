<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nome -->
        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" required />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="mt-4">
            <x-input-label for="datanasc" :value="__('Data de Nascimento')" />
            <x-text-input id="datanasc" class="block mt-1 w-full" type="date" name="datanasc" :value="old('datanasc')" required />
            <x-input-error :messages="$errors->get('datanasc')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="tipousu" class="block text-sm font-medium text-gray-700">Tipo de Usuário</label>
            <select id="tipousu" name="tipousu" required onchange="OcultarCnpj(this.value)" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="Cliente" {{ old('tipousu') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="Locador" {{ old('tipousu') == 'Locador' ? 'selected' : '' }}>Locador</option>
            </select>
            @error('tipousu')
            <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- CNPJ (mostrar apenas se tipo de usuário for Locador) -->
        <div id="cnpjField" class="mt-4" style="display: {{ old('tipousu') === 'Locador' ? 'block' : 'none' }}">
            <x-input-label for="cnpj" :value="__('CNPJ')" />
            <x-text-input id="cnpj" class="block mt-1 w-full" type="text" name="cnpj" :value="old('cnpj')"/>
            <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
        </div>

        <!-- Cidade -->
        <div class="mt-4">
            <x-input-label for="cidade" :value="__('Cidade')" />
            <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade')" required />
            <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
        </div>

        <!-- CEP -->
        <div class="mt-4">
            <x-input-label for="cep" :value="__('CEP')" />
            <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" required />
            <x-input-error :messages="$errors->get('cep')" class="mt-2" />
        </div>

        <!-- Número -->
        <div class="mt-4">
            <x-input-label for="numero" :value="__('Número')" />
            <x-text-input id="numero" class="block mt-1 w-full" type="text" name="numero" :value="old('numero')" required />
            <x-input-error :messages="$errors->get('numero')" class="mt-2" />
        </div>

        <!-- Bairro -->
        <div class="mt-4">
            <x-input-label for="bairro" :value="__('Bairro')" />
            <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro')" required />
            <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function OcultarCnpj(tipoUsu) {
            var cnpjField = document.getElementById("cnpjField");
            var cnpjInput = document.getElementById("cnpj");
            if (tipoUsu === "Locador") {
                cnpjField.style.display = "block";
            } else {
                cnpjField.style.display = "none";
                cnpjInput.value = "";
            }
        }
    </script>
</x-guest-layout>
