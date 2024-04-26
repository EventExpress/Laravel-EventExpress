<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anuncio = Anuncio::all();
        return view('anuncio.index',['anuncio'=> $anuncio]);   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('anuncio.createanuncio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'categoria'=> 'required',
            'endereco'=>'required',
            'capacidade'=>'required',
            'descricao'=>'required',
            'locador'=>'required',
            'valor'=>'required',
            'agenda'=>'required',
            'status'=>'required'
        ]);

        $endereco = new Endereco();
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->save();       


        $anuncio = new Anuncio();
        $anuncio->titulo = $request->titulo;
        $anuncio->categoria = $request->categoria;
        $anuncio->endreco_id = $endereco->id;
        $anuncio->capacidade = $request->capacidade;
        $anuncio->descricao = $request->descricao;
        $anuncio->usuario = $request->usuario;
        $anuncio->valor = $request->valor;
        $anuncio->agenda = $request->agenda;
        $anuncio->status = $request->status;
        $anuncio->save();

        return redirect('/anuncio.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnuncioController $anuncio)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnuncioController $anuncio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnuncioController $anuncio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnuncioController $anuncio)
    {
        //
    }
}
