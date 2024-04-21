<?php

namespace App\Http\Controllers;

use App\Models\Locador;
use App\Models\Nome;
use Illuminate\Http\Request;

class LocadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $locador = Locador::all();
    return view('locador.index',['locador'=>$locador]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('locador.create');
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
            'cpf'=>'required',
            'cnpj'=>'required',
            'endereco'=>'required']);

        $locador = new Locador();
        $locador =
        $locador->telefone = $request->telefone;
        $locador->email = $request->email;
        $locador->cpf = $request->cpf;
        $locador->cnpj = $request->cnpj;
        $locador->endereco = $request->endereco;
        $locador->save();


        $nome = new Nome();
        $nome->nome = $request->nome;
        $nome ->usuario_id = 'null';
        $nome->locador_id = $locador->id;
        $nome->save();

        return redirect('/locador');

    }

    /**
     * Display the specified resource.
     */
    public function show(LocadorController $locador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocadorController $locador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocadorController $locador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocadorController $locador)
    {
        //
    }
}
