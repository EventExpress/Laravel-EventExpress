<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $user->nome)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nome')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" name="telefone" type="text" class="mt-1 block w-full" :value="old('telefone', $user->telefone)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
        </div>

        <div>
            <x-input-label for="datanasc" :value="__('Data de Nascimento')" />
            <input id="datanasc" name="datanasc" type="date" class="mt-1 block w-full form-input rounded-md shadow-sm" value="{{ old('datanasc', $user->datanasc) }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('datanasc')" />
        </div>


        <div>
            <x-input-label for="tipousu" :value="__('Tipo de Usuário')" />
            <select id="tipousu" name="tipousu" required onchange="OcultarCnpj(this.value)" class="mt-1 block w-full">
                <option value="Cliente" {{ old('tipousu', $user->tipousu) == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="Locador" {{ old('tipousu', $user->tipousu) == 'Locador' ? 'selected' : '' }}>Locador</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('tipousu')" />
        </div>

        <div>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full" :value="old('cpf', $user->cpf)" required />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>

        <div id="cnpjField" style="display: {{ old('tipousu', $user->tipousu) === 'Locador' ? 'block' : 'none' }}">
            <x-input-label for="cnpj" :value="__('CNPJ')" />
            <x-text-input id="cnpj" name="cnpj" type="text" class="mt-1 block w-full" :value="old('cnpj', $user->cnpj)" />
            <x-input-error class="mt-2" :messages="$errors->get('cnpj')" />
        </div>

        <div>
            <x-input-label for="cidade" :value="__('Cidade')" />
            <x-text-input id="cidade" name="cidade" type="text" class="mt-1 block w-full" :value="old('cidade', $user->endereco->cidade)" required />
            <x-input-error class="mt-2" :messages="$errors->get('cidade')" />
        </div>

        <div>
            <x-input-label for="cep" :value="__('CEP')" />
            <x-text-input id="cep" name="cep" type="text" class="mt-1 block w-full" :value="old('cep', $user->endereco->cep)" required />
            <x-input-error class="mt-2" :messages="$errors->get('cep')" />
        </div>

        <div>
            <x-input-label for="numero" :value="__('Número')" />
            <x-text-input id="numero" name="numero" type="text" class="mt-1 block w-full" :value="old('numero', $user->endereco->numero)" required />
            <x-input-error class="mt-2" :messages="$errors->get('numero')" />
        </div>

        <div>
            <x-input-label for="bairro" :value="__('Bairro')" />
            <x-text-input id="bairro" name="bairro" type="text" class="mt-1 block w-full" :value="old('bairro', $user->endereco->bairro)" required />
            <x-input-error class="mt-2" :messages="$errors->get('bairro')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Salvo.') }}</p>
            @endif
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
</section>
