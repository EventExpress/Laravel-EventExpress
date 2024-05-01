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


    public function verificaLocador($usuarioId)
{
    $usuario = Usuario::find($usuarioId);

    if (!$usuario->tipouso === 'Cliente') {
        return false; // Retorna falso se o usuário não for encontrado
    }
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
    public function show(Request $request)
    {
        $search = $request->input('search');

        // Realiza a pesquisa nos campos desejados
        $results = Anuncio::whereHas('endereco', function ($query) use ($search) {
                    $query->where('cidade', 'like', "%$search%")
                          ->orWhere('cep', 'like', "%$search%")
                          ->orWhere('numero', 'like', "%$search%")
                          ->orWhere('bairro', 'like', "%$search%");
                })
                ->orWhere('titulo', 'like', "%$search%")
                ->orWhere('capacidade', 'like', "%$search%")
                ->orWhere('descricao', 'like', "%$search%")
                ->orWhereHas('usuario', function ($query) use ($search) {
                    $query->where('nome', 'like', "%$search%");
                })
                ->orWhere('valor', 'like', "%$search%")
                ->orWhere('agenda', 'like', "%$search%")
                ->get();
    
        return view('anuncio.searchanuncio', compact('results'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anuncio = Anuncio::find($id);
        return view('anuncio.editaanuncio', compact('anuncio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $anuncio = Anuncio::find($id);  
        return redirect('/anuncio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->delete();
        return redirect('/anuncio');
    }
}
