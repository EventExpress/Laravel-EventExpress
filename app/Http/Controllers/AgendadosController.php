<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendados = Agendados::all();
        return view('agendados.index',['agendados'=>$agendados]);   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('agendados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'reservas'=> 'required',
            'contrato'=>'required'
        ]);

        $agendados = new Agendados();
        $agendados->nome = $request->nome;
        $agendados->reservas = $request->reservas;
        $agendados->contrato = $request->contrato;

        $agendados->save();

        return redirect('/agendados');

    }

    /**
     * Display the specified resource.
     */
    public function show(AgendadosController $agendados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgendadosController $agendados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AgendadosController $agendados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgendadosController $agendados)
    {
        //
    }
}
