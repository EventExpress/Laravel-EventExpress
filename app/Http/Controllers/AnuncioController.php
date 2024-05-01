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
        $anuncio = Anuncio::all();
        return view('anuncio.index',['anuncio'=> $anuncio]);
    }


    public function buscaUsuario($usuarios) {
        $buscausuario = Usuario::find($usuarios);
        return $buscausuario;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($usuarios)
    {
        $usuarioId = $usuarios;
        $usuario = $this->buscaUsuario($usuarioId);
        return view('anuncio.create',['usuario'=>$usuario]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'cidade' => 'required',
            'cep' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'capacidade'=>'required',
            'descricao'=>'required',
            'valor'=>'required',
            'agenda'=>'required',
        ]);
        $usuarioId = $request->input('usuario_id');

        $endereco = new Endereco();
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->save();

        $usuario = Usuario::find($usuarioId);
        if (!$usuario) {
            return redirect('/anuncio')->with('error', 'Usuário não encontrado');
        }

        $anuncio = new Anuncio();
        $anuncio-> usuario_id =$usuarioId;
        $anuncio->titulo = $request->titulo;
        $anuncio->endereco_id = $endereco->id;
        $anuncio->capacidade = $request->capacidade;
        $anuncio->descricao = $request->descricao;
        $anuncio->valor = $request->valor;
        $anuncio->agenda = $request->agenda;
        $anuncio->save();

        return redirect('/anuncio');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnuncioController $anuncio,$id)
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
