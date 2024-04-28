<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adicional;
use App\Models\Anuncio;
use App\Models\Categoria;
use App\Models\Status;

class AdicionalController extends Controller
{
    public function index()
    {
        $adicional = Adicional::all();
        return view('adicional.index',['adicional'=> $adicional]);
    }

    public function create()
    {
        return view('adicional.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'anuncio_id' => 'required',
            'categoria_id' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'disponibilidade' => 'required',
            'status' => 'required'
        ]);

        $adicional = new Adicional();
        $adicional->titulo = $request->titulo;
        $adicional->anuncio_id = $request->anuncio;
        $adicional->categoria_id = $request->categoria;
        $adicional->descricao = $request->descricao;
        $adicional->valor = $request->valor;
        $adicional->disponibilidade = $request->disponibilidade;
        $adicional->status = $request->status;
        $adicional->save();

        return redirect()->route('adicional.index')->with('categoria criada com sucesso');
    }
    public function show(Request $request){

        $search = $request->input('search');
        
        $results = Adicional::where('titulo','like',"%$search%")
            ->orWhere('valor','like',"%$search%")
            ->orWhere('categoria','like',"%$search%")
            ->orWhere('anuncio','like',"%$search%")
            ->get();

        return view('adicional.search', compact('results'));
    }

    public function edit($id)
    {
        $adicional = Adicional::find($id);
        return view('adicional.edit',compact('adicional'));
    }

    public function update(Request $request, $id)
    {
        $adicional = Adicional::find($id);

        if (!$adicional){
            return redirect()->route('adicional.index')->with('Adicional não encontrado');
        }
        $adicional->update($request->all());
        if ($request->has('titulo')){
            $adicional->update(['titulo' => $request->input('titulo')]);
        }

        return redirect()->route('adicional.index')->with('Adicional atualizada com sucesso');
    }

    public function destroy($id)
    {
        $adicional = Adicional::findOrFail($id);

        if ($adicional){
            $adicional->delete();
            return redirect()->route('adicional.index')->with('Adicional excluída com sucesso.');
        }
        else {
            return redirect()->route('adicional.index')->with('Adicional não encontrado.');
        }
    }
}