<?php

namespace App\Http\Controllers;

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
            'nome' => 'required',
            'telefone'=> 'required',
            'datanasc'=>'required',
            'email'=>'required',
            'tipousu'=>'required',
            'cpf'=>'required',
            'cnpj'=> $request->tipousu === 'Locador' ? 'required' : 'nullable', //validação de acordo com o cadastro do usuario
            'endereco'=>'required']);

        $usuario = new Usuario();
        $usuario->telefone = $request->telefone;
        $usuario->datanasc = $request->datanasc;
        $usuario->email = $request->email;
        $usuario->tipousu = $request->tipousu;
        $usuario->cpf = $request->cpf;
        $usuario->cnpj = $request->cnpj;
        $usuario->nome = $request->nome;
        $usuario->endereco = $request->endereco;
        $usuario->save();


        $nome = new Nome();
        $nome->nome = $request->nome;
        $nome->usuario_id = $usuario->id;
        $nome->save();

        return redirect('/usuario');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $search = $request->input('search');
        $results = Usuario::where('nome','like',"%$search%")->get();
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
        $nome = Nome::where('usuario_id', $id);
        $usuario->update($request->all());
        if ($nome) {
            $nome->update(['nome' => $request->input('nome')]);
        } else {
            return redirect()->route('usuario.index')->with('Nome não encontrado.');
        }

        return redirect()->route('usuario.index')->with('Usuário e nome atualizados com sucesso.');
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
            return redirect()->route('usuario.index');
        } else {
            return redirect()->route('usuario.index');
        }
    }

}
