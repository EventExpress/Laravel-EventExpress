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
        return view ('endereco.createendereco');
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
    public function show(Request $request)
    {
        $search = $request->input('search');

        // Realiza a pesquisa nos campos desejados
        $results = Endereco::where('cidade', 'like', "%$search%")
                           ->orWhere('cep', 'like', "%$search%")
                           ->orWhere('numero', 'like', "%$search%")
                           ->orWhere('bairro', 'like', "%$search%")
                           ->get();
    
        return view('endereco.searchendereco', compact('results'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $endereco = Endereco::find($id);
        return view('endereco.editaendereco', compact('endereco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $endereco = Endereco::find($id);

        if (!$endereco) {
            return redirect()->route('endereco.index')->with('error', 'Endereço não encontrado.');
        }
    
        $endereco->update($request->all());
        if ($request->has('nome')) {
            $endereco->update(['nome' => $request->input('nome')]);
        }
    
        return redirect()->route('endereco.index')->with('success', 'Endereço atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $endereco = Endereco::findOrFail($id);

        if ($endereco) {
            $endereco->delete(); // Deleta o endereço
            return redirect()->route('endereco.index')->with('success', 'Endereço e todas as suas relações deletadas com sucesso.');
        } else {
            return redirect()->route('endereco.index')->with('error', 'Endereço não encontrado.');
        }
    }
    
}
