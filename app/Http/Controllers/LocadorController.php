<?php

namespace App\Http\Controllers;

use App\Models\Locador;
use Illuminate\Http\Request;

class LocadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $locador = Locador::all();
    return view('locador.index',['locador'=>$locador]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LocadorController $locador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocadorController $locador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocadorController $locador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocadorController $locador)
    {
        //
    }
}
