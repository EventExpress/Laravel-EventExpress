<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $endereco = Endereco::all();
        return view('endereco.index',['endereco'=>$endereco]);   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('endereco.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cidade' => 'required',
            'cep'=> 'required',
            'numero'=>'required',
            'bairro'=>'required'
        ]);

        $endereco = new Endereco();
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->save();

        return redirect('/endereco');

    }

    /**
     * Display the specified resource.
     */
    public function show(EnderecoController $endereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnderecoController $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnderecoController $endereco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnderecoController $endereco)
    {
        //
    }
}
