<?php

namespace App\Http\Controllers;


use App\Models\Agendado;
//use App\Models\Adicional;
use App\Models\Anuncio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendadoController extends Controller
{
    public function index()
    {
        $agendado = Agendado::all();
        return view('agendado.index', ['agendado' => $agendado]);
    }

    /**
     * Mostra o formulário para criar um novo agendado para um anúncio específico.
     */
    public function create($anuncioId)
    {

        $anuncio = Anuncio::find($anuncioId);

        if (!$anuncio) {
            return redirect()->route('anuncio.index')->with('error', 'Anúncio não encontrado.');
        }

        return view('agendado.create', ['anuncio' => $anuncio]);
    }

    /**
     * Armazena um novo agendado no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anuncio_id' => 'required',
            'data_inicio' => 'required',
            'data_fim' => 'required',
        ]);

        $dataInicio = Carbon::parse($request->data_inicio)->toDateTimeString();
        $dataFim = Carbon::parse($request->data_fim)->toDateTimeString();

        $agendado = new Agendado();
        $agendado->anuncio_id = $request->anuncio_id;
        $agendado->data_inicio = $dataInicio;
        $agendado->data_fim = $dataFim;
        $agendado->confirmado = false; // Por padrão, novo agendado não está confirmado
        $agendado->save();

        return redirect('/anuncio');
    }

    public function show(Request $request)
{
    $search = $request->input('search');


    $agendado = Agendado::whereHas('anuncio', function ($query) use ($search) {
        $query->where('titulo', 'like', "%$search%");
    })->get();

    return view('agendado.search', compact('agendado'));
}

    /**
     * Mostra o formulário para editar um agendado existente.
     */
    public function edit($id)
    {
        $agendado = Agendado::find($id);

        if (!$agendado) {
            return redirect()->route('agendado.index')->with('Reserva não encontrada.');
        }

        return view('agendado.edit', compact('agendado'));
    }

    /**
     * Atualiza um agendado existente no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'data_inicio' => 'required',
            'data_fim' => 'required',
        ]);

        $agendado = Agendado::find($id);

        if (!$agendado) {
            return redirect()->route('agendado.index')->with('Reserva não encontrada.');
        }

        $agendado->data_inicio = $request->data_inicio;
        $agendado->data_fim = $request->data_fim;
        $agendado->save();

        return redirect()->route('agendado.index')->with('Reserva atualizada com sucesso.');
    }

    /**
     * Remove um agendado do banco de dados.
     */
    public function destroy($id)
    {
        $agendado = Agendado::find($id);

        if (!$agendado) {
            return redirect()->route('agendado.index')->with('Reserva não encontrada.');
        }

        $agendado->delete();

        return redirect()->route('agendado.index')->with('Reserva cancelada com sucesso.');
    }
}
