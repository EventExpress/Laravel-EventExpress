<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = auth()->user(); // Obter o usuário autenticado

        // Atualizar os atributos do usuário com os dados validados do request
        $user->fill($request->validated());

        // Verificar se o email foi alterado para redefinir a verificação
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Salvar as alterações no usuário
        $user->save();

        // Atualizar o nome do usuário
        $nome = $user->nome ?? new Nome();
        $nome->nome = $request->input('nome');
        $nome->save();
        $user->nome_id = $nome->id;

        // Atualizar o endereço do usuário
        $endereco = $user->endereco ?? new Endereco();
        $endereco->fill($request->only(['cidade', 'cep', 'numero', 'bairro']));
        $endereco->save();
        $user->endereco_id = $endereco->id;

        // Salvar o usuário novamente para refletir as alterações nos relacionamentos
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
