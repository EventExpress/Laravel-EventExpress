<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Nome;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = Usuario::all();
        return view ('usuario.indexusers',['usuario'=> $usuario]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('usuario.createusu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'telefone' => 'required|string|min:10|max:15',
            'datanasc' => 'required|date',
            'email' => 'required|email|min:5|max:255',
            'tipousu' => 'required|string|min:3|max:50',
            'cpf' => 'required|integer|min:11',
            'cnpj' => $request->tipousu === 'Locador' ? 'required|string|min:14|max:14' : 'nullable',
            'cidade' => 'required|string|min:3|max:255',
            'cep' => 'required|string|min:8|max:9',
            'numero' => 'required|integer|min:1',
            'bairro' => 'required|string|min:3|max:255'
        ]);

        $nome = new Nome();
        $nome->nome = $request->nome;
        $nome->save();

        $endereco = new Endereco();
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->save();

        $usuario = new Usuario();
        $usuario->nome_id = $nome->id;
        $usuario->telefone = $request->telefone;
        $usuario->datanasc = $request->datanasc;
        $usuario->email = $request->email;
        $usuario->tipousu = $request->tipousu;
        $usuario->cpf = $request->cpf;
        $usuario->cnpj = $request->cnpj;
        $usuario->endereco_id = $endereco->id;
        $usuario->save();

        return redirect('/usuario')->with('success', 'Jogador criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $search = $request->input('search');

        $results = Usuario::whereHas('nome', function ($query) use ($search) {
            $query->where('nome', 'like', "%$search%");
        })->orWhere('telefone', 'like', "%$search%")
            ->orWhere('cpf', 'like', "%$search%")
            ->orWhere('tipousu', 'like', "%$search%")
            ->get();

        return view('usuario.search', compact('results'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::with('nome')->find($id);
        return view('usuario.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return redirect()->route('usuario.index')->with('Usuário não encontrado.');
        }

        $request->validate([
            'nome' => 'required|string|min:4|max:255',
            'telefone' => 'required|string|min:10|max:15',
            'datanasc' => 'required|date',
            'email' => 'required|email|min:5|max:255',
            'tipousu' => 'required|string|min:3|max:50',
            'cpf' => 'required|integer|min:11',
            'cnpj' => $request->tipousu === 'Locador' ? 'required|string|min:14|max:14' : 'nullable',
            'cidade' => 'required|string|min:3|max:255',
            'cep' => 'required|string|min:8|max:9',
            'numero' => 'required|integer|min:1',
            'bairro' => 'required|string|min:3|max:255'
        ]);

        $usuario->update([
            'telefone' => $request->telefone,
            'datanasc' => $request->datanasc,
            'email' => $request->email,
            'tipousu' => $request->tipousu,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
        ]);

        $nome = Nome::find($usuario->nome_id);
        if ($nome) {
            $nome->update(['nome' => $request->input('nome')]);
        } else {
            return redirect()->route('usuario.index')->with('Nome não encontrado.');
        }
        $endereco = Endereco::find($usuario->endereco_id);
        if ($endereco) {
            $endereco->update([
                'cidade' => $request->cidade,
                'cep' => $request->cep,
                'numero' => $request->numero,
                'bairro' => $request->bairro
            ]);
        } else {
            return redirect()->route('usuario.index')->with('error', 'Endereço não encontrado.');
        }

        return redirect()->route('usuario.index')->with('Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Usuario::FindOrFail($id);

        if (request()->has('_token')){
            $delete->delete();
            $delete->nome()->delete();
            $delete->endereco()->delete();

            return redirect()->route('usuario.index');
        } else {
            return redirect()->route('usuario.index');
        }
    }

}
