<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = Categoria::all();
        return view('categoria.index',['categoria'=> $categoria]);
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:90',
            'descricao' => 'required|string|max:300',
        ]);
        Categoria::create([
            'titulo'=>$request->titulo,
            'descricao'=>$request->descricao
        ]);


        return redirect()->route('categoria.index')->with('categoria criada com sucesso');
    }

    public function show(Request $request){
        $search = $request->input('search');
        $categoria = Categoria::where('titulo','like',"%$search%")->get();
        return view('categoria.search', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit',compact('categoria'));
    }

    public function update(Request $request, $id)
    {

        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:90',
            'descricao' => 'required|string|max:300',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categoria.index')->with('Categoria atualizada com sucesso');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoria.index')->with('Categoria excluída com sucesso.');
    }
}
