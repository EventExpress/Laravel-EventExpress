<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adicional;


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
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'valor' => 'required|numeric|min:0',
        ]);

        $adicional = new Adicional();
        $adicional->titulo = $request->titulo;
        $adicional->descricao = $request->descricao;
        $adicional->valor = $request->valor;
        $adicional->save();

        return redirect()->route('adicional.index')->with('adicional criada com sucesso');
    }
    public function show(Request $request){

        $search = $request->input('search');

        $adicional = Adicional::where('titulo','like',"%$search%")
            ->orWhere('valor','like',"%$search%")
            ->get();

        return view('adicional.search', compact('adicional'));
    }

    public function edit($id)
    {
        $adicional = Adicional::find($id);
        return view('adicional.edit',compact('adicional'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:1000',
            'valor' => 'required|numeric|min:0',
        ]);

        $adicional = Adicional::find($id);

        if (!$adicional) {
            return redirect()->route('adicional.index')->with('Adicional não encontrado.');
        }
        $adicional->titulo = $request->titulo;
        $adicional->descricao = $request->descricao;
        $adicional->valor = $request->valor;
        $adicional->save();

        return redirect()->route('adicional.index')->with('Adicional atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $adicional = Adicional::find($id);

        if (!$adicional) {
            return redirect()->route('adicional.index')->with('Adicional não encontrado.');
        }

        $adicional->delete();

        return redirect()->route('adicional.index')->with('Adicional cancelado com sucesso.');
    }
}
