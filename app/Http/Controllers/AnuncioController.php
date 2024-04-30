<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Usuario;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anuncio = Anuncio::with('usuario')->get();
        return view('anuncio.index',['anuncio'=>$anuncio]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $usuario)
    {

        return view('anuncio.create', ['usuario' => $usuario]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'categoria'=> 'required',
            'cidade' => 'required',
            'cep' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'capacidade'=>'required',
            'descricao'=>'required',
            'valor'=>'required',
            'agenda'=>'required',
            'status'=>'required'
        ]);

        $usuario = Usuario::with('usuario')->find($id);

        $endereco = new Endereco();
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->save();      

        $anuncio = new Anuncio();
        $anuncio->usuario_id = $usuario;
        $anuncio->titulo = $request->titulo;
        $anuncio->categoria = $request->categoria;
        $anuncio->endereco_id = $endereco->id;
        $anuncio->capacidade = $request->capacidade;
        $anuncio->descricao = $request->descricao;
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
