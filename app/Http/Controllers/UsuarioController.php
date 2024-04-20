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
            'email'=>'required',
            'datanasc'=>'required',
            'cpf'=>'required']);

        $usuario = new Usuario();
        $usuario->telefone = $request->telefone;
        $usuario->email = $request->email;
        $usuario->datanasc = $request->datanasc;
        $usuario->cpf = $request->cpf;
        $usuario->nome = $request->nome; // Certifique-se de que existe um campo 'nome' na tabela 'usuarios'
        $usuario->save();


        $nome = new Nome();
        $nome->nome = $request->nome;
        $nome->usuario_id = $usuario->id; // Supondo que a coluna de chave estrangeira seja usuario_id
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
        $usuario = Usuario::find($id);
        return view('usuario.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $usuario = Usuario::find($id);
        $usuario->update($request->all());
        $nome = Nome::find($id);
        $nome->update(['nome' => $request->input('nome')]);
        return redirect()->route('usuario.index');
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
