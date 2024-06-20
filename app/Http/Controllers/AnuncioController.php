<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\Usuario;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function meusAnuncios()
    {
        $user = Auth::user();
        if ($user->tipousu !== 'Locador') {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para criar anúncios.');
        }

        $user_id = auth()->user()->id;
        $anuncio = Anuncio::where('usuario_id', $user_id)->get();

        return view('meusanuncios', compact('anuncio'));
    }

    public function create()
    {
        $user = Auth::user();

        // Verifica se o usuário autenticado é um Locador
        if ($user->tipousu !== 'Locador') {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para criar anúncios.');
        }

        // Carrega as categorias disponíveis
        $categoria = Categoria::all();

        return view('anuncio.create', compact('user', 'categoria'));
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

        // Cria o novo endereço
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
        $anuncio->usuario_id = Auth::id();
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
            return redirect()->route('dashboard')->with('error', 'Erro ao criar anúncio');
        }

        return redirect()->route('dashboard')->with('success', 'Anúncio criado com sucesso.');
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

        $user = Auth::user();

        if (!$anuncio || $anuncio->usuario_id != $user->id) {
        return redirect()->route('anuncio.index')->with( 'Anúncio não encontrado ou você não tem permissão para editá-lo.');
    }

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

        $user = Auth::user();
        $anuncio = Anuncio::find($id);

        if (!$anuncio || $anuncio->usuario_id != $user->id) {
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
        $user = Auth::user();
        $anuncio = Anuncio::find($id);

        if (!$anuncio || $anuncio->usuario_id != $user->id) {
            return redirect()->route('anuncio.index')->with('error', 'Anúncio não encontrado ou você não tem permissão para excluí-lo.');
        }

        $anuncio->delete();
        $anuncio->endereco()->delete();
        return redirect('/anuncio');
    }

}
