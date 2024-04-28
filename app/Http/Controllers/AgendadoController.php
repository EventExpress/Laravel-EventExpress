<?php

namespace App\Http\Controllers;

use App\Models\Nome;
use App\Models\Agendado;
use App\Models\Adicional;
use App\Models\Anuncio;
use Illuminate\Http\Request;

class AgendadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendado = Agendado::all();
        return view('agendados.index',['agendado'=>$agendado]);   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('agendado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'anuncio' => 'required',
            'adicional'=>'required',
            'status' => 'required'
        ]);

        $agendado = new Agendado();
        $agendado->nome = $request->nome;
        $agendado->anuncio = $request->anuncio;
        $agendado->adicional = $request->adicional;
        $agendado->status = $request->status;

        $agendado->save();

        return redirect('/agendado');

    }

    /**
     * Display the specified resource.
     */
    public function show(AgendadoController $agendado)
    {
                
        $search = $request->input('search');
        $agendado = Agendado::where('nome','like',"%$search%")->get();

        return view('agendado.search', compact('agendado'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $agendado = Agendado::findOrFail($id);
        return view('agendado.edit',compact('agendado'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $agendado)
    {
        $agendado = Agendado::find($id);
    
        if (!$agendado) {
            return redirect()->route('agendado.index')->with( 'Reserva não encontrada.');
        }
    
        $agendado->update($request->all());
    
        if ($request->has('anuncio_id')) {
            $anuncio = Anuncio::find($request->input('anuncio_id'));
            if ($anuncio) {
                $anuncio->update(['agenda' => $request->input('agenda')]);
            }
        }
    
        if ($request->has('adicional_id')) {
            $adicional = Adicional::find($request->input('adicional_id'));
            if ($adicional) {
                $adicional->update(['adicional' => $request->input('adicional')]);
            }
        }
    
        return redirect()->route('agendado.index')->with('Reserva atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgendadoController $agendado)
    {
        {
            $agendado = Agendado::findOrFail($id);
            $agendado->delete();
    
            return redirect()->route('agendado.index')->with('Reserva cancelada com sucesso.');
        }
    }
}