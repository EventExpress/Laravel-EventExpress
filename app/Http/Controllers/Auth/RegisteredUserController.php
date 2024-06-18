<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\Nome;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'telefone' => 'required|string|min:10|max:15',
            'datanasc' => 'required|date',
            'email' => 'required|email|min:5|max:255',
            'tipousu' => 'required|string|min:3|max:50',
            'cpf' => 'required|string|size:11',
            'cnpj' => $request->tipousu === 'Locador' ? 'required|string|min:14|max:14' : 'nullable',
            'cidade' => 'required|string|min:3|max:255',
            'cep' => 'required|string|min:8|max:9',
            'numero' => 'required|integer|min:1',
            'bairro' => 'required|string|min:3|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $nome = Nome::create([
            'nome' => $request->nome
        ]);

        $endereco = Endereco::create([
            'cidade' => $request->cidade,
            'cep' => $request->cep,
            'numero' => $request->numero,
            'bairro' => $request->bairro
        ]);


        Auth::login($user = Usuario::create([
            'nome_id' => $nome->id,
            'telefone' => $request->telefone,
            'datanasc' => $request->datanasc,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipousu' => $request->tipousu,
            'cpf' => $request->cpf,
            'cnpj' => $request->tipousu === 'Locador' ? $request->cnpj : null,
            'endereco_id' => $endereco->id
        ]));

        event(new Registered($user));

        return redirect(route('dashboard'));
    }

}
