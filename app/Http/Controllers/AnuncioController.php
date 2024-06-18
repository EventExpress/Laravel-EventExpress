<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
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

    public function create($usuarios)
    {
        $usuarioId = $usuarios;
        $usuario = $this->buscaUsuario($usuarioId);
        $categoria = Categoria::all();

        if ($this->verificaLocador($usuarioId)) {
            return redirect('/')->with('error', 'Você não tem permissão para criar anúncios.');
        }

        return view('anuncio.create', ['usuario' => $usuario, 'categoria' => $categoria]);
    }
    public function verificaLocador($usuarioId)
    {
        $usuario = Usuario::find($usuarioId);

        if ($usuario && $usuario->tipousu === 'Locador') {
            return false;
        }

        return true;
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|min:4|max:255',
            'cidade' => 'required|string|min:3|max:255',
            'cep' => 'required|string|min:8|max:9',
            'numero' => 'required|integer|min:1',
            'bairro' => 'required|string|min:3|max:255',
            'capacidade' => 'required|integer|min:1|max:10000',
            'descricao' => 'required|string|min:10|max:2000',
            'valor' => 'required|numeric|min:0',
            'agenda' => 'required|date',
            'categoriaId' => 'required|array',
        ]);
        $usuarioId = $request->input('usuario_id');

        $endereco = new Endereco();
        $endereco->cidade = $request->cidade;
        $endereco->cep = $request->cep;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->save();

        if (!$endereco) {
            return redirect('/anuncio')->with('error', 'Erro ao salvar endereço');
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
        $anuncio->categoria()->attach($request->categoriaId);
        /**$categoriaId = $request->categoriaId;
        $anuncio->categoria()->attach($categoriaId);
        */
        if (!$anuncio) {
            return redirect('/anuncio')->with('error', 'Erro ao criar anúncio');
        }

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

        $categoria = Categoria::all();

        $categoriaSelecionada = $anuncio->categoria->pluck('id')->toArray();

        return view('anuncio.editaanuncio', [
        'anuncio' => $anuncio,
        'categoria' => $categoria,
        'categoriaSelecionada' => $categoriaSelecionada,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validação dos dados do formulário
        $request->validate([
            'titulo' => 'required|string|min:4|max:255',
            'cidade' => 'required|string|min:3|max:255',
            'cep' => 'required|string|min:8|max:9',
            'numero' => 'required|integer|min:1',
            'bairro' => 'required|string|min:3|max:255',
            'capacidade' => 'required|integer|min:1|max:10000',
            'descricao' => 'required|string|min:10|max:2000',
            'categoriaId' => 'required|array'
        ]);

        $anuncio = Anuncio::find($id);

        if (!$anuncio) {
            return redirect()->route('anuncio.index')->with('error', 'Anúncio não encontrado.');
        }

        $anuncio->update([
            'titulo' => $request->titulo,
            'capacidade' => $request->capacidade,
            'descricao' => $request->descricao,
        ]);
        $anuncio->categoria()->sync($request->categoriaId);

        $endereco = Endereco::find($anuncio->endereco_id);

        $endereco->update(['cidade' => $request->input('cidade')]);
        $endereco->update(['cep' => $request->input('cep')]);
        $endereco->update(['numero' => $request->input('numero')]);
        $endereco->update(['bairro' => $request->input('bairro')]);

        return redirect()->route('anuncio.index')->with('success', 'Anúncio atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->delete();
        $anuncio->endereco()->delete();
        return redirect('/anuncio');
    }

}
