<?php

namespace App\Http\Controllers;

use App\Models\Agendado;
use App\Models\Adicional;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendadoController extends Controller
{
    public function index()
    {
        $agendado = Agendado::all();
        $user = Auth::user();

        if ($user->tipousu === 'Cliente') {
            $agendado = Agendado::where('usuario_id', $user->id)->get();
        }
        else if ($user->tipousu === 'Locador') {
            $agendado = Agendado::whereHas('anuncio', function ($query) use ($user) {
                $query->where('usuario_id', $user->id);
            })->get();
        }
        return view('agendado.index', ['agendado' => $agendado]);
    }

    public function create($anuncioId)
    {
        $user = Auth::user();

        //if ($user->tipousu !== 'Cliente') {
        //  return redirect()->route('dashboard')->with('error', 'Você não tem permissão para criar anúncios.');
        //}

        $anuncio = Anuncio::find($anuncioId);
        $adicional = Adicional::all();
        if (!$anuncio) {
            return redirect()->route('anuncio.index')->with('error', 'Anúncio não encontrado.');
        }

        return view('agendado.create', ['anuncio' => $anuncio, 'adicional' => $adicional]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'anuncio_id' => 'required',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'adicionalId' => 'nullable|array',
        ]);

        $dataInicio = Carbon::parse($request->data_inicio)->toDateTimeString();
        $dataFim = Carbon::parse($request->data_fim)->toDateTimeString();

        // Verifica se há conflitos de data para o mesmo anúncio
        $conflict = Agendado::where('anuncio_id', $request->anuncio_id)
            ->where(function ($query) use ($dataInicio, $dataFim) {
                $query->where(function ($query) use ($dataInicio, $dataFim) {
                    $query->where('data_inicio', '<=', $dataFim)
                        ->where('data_fim', '>=', $dataInicio);
                });
            })
            ->exists();

        if ($conflict) {
            return redirect()->route('anuncio.index')->with('error', 'Este anúncio já está reservado para as datas selecionadas.');
        }

        $agendado = new Agendado();
        $agendado->anuncio_id = $request->anuncio_id;
        $agendado->usuario_id = Auth::id();
        $agendado->data_inicio = $dataInicio;
        $agendado->data_fim = $dataFim;
        $agendado->save();

        if ($request->has('adicionalId') && is_array($request->adicionalId)) {
            $validAdicionalIds = array_filter($request->adicionalId, function ($id) {
                return !is_null($id) && is_numeric($id);
            });

            if (!empty($validAdicionalIds)) {
                $agendado->adicional()->attach($validAdicionalIds);
            }
        }

        return redirect('/agendado')->with('success', 'Reserva criada com sucesso.');
    }

    public function show(Request $request)
    {
        $search = $request->input('search');

        $agendado = Agendado::whereHas('anuncio', function ($query) use ($search) {
            $query->where('titulo', 'like', "%$search%");
        })->get();

        return view('agendado.search', compact('agendado'));
    }

    public function edit($id)
    {
        $agendado = Agendado::find($id);
        $user = Auth::user();

        if (!$agendado || $agendado->usuario_id != $user->id) {
            return redirect()->route('agendado.index')->with('error', 'Reserva não encontrada.');
        }
        $adicional = Adicional::all();
        $adicionaisSelecionados = $agendado->adicional->pluck('id')->toArray();

        return view('agendado.edit', [
            'agendado' => $agendado,
            'adicional' => $adicional,
            'adicionaisSelecionados' => $adicionaisSelecionados,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'adicionalId' => 'nullable|array',
        ]);

        $agendado = Agendado::find($id);
        $user = Auth::user();

        if (!$agendado || $agendado->usuario_id != $user->id) {
            return redirect()->route('agendado.index')->with('error', 'Reserva não encontrada.');
        }

        // Verifica se há conflitos de data para o mesmo anúncio
        $dataInicio = Carbon::parse($request->data_inicio)->toDateTimeString();
        $dataFim = Carbon::parse($request->data_fim)->toDateTimeString();

        $conflict = Agendado::where('anuncio_id', $agendado->anuncio_id)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($dataInicio, $dataFim) {
                $query->where(function ($query) use ($dataInicio, $dataFim) {
                    $query->where('data_inicio', '<=', $dataFim)
                        ->where('data_fim', '>=', $dataInicio);
                });
            })
            ->exists();

        if ($conflict) {
            return redirect()->route('anuncio.index')->with('error', 'Este anúncio já está reservado para as datas selecionadas.');
        }

        $agendado->data_inicio = $request->data_inicio;
        $agendado->data_fim = $request->data_fim;
        $adicionalId = $request->adicionalId;
        $agendado->save();

        if ($request->has('adicionalId') && is_array($request->adicionalId)) {
            $validAdicionalIds = array_filter($request->adicionalId, function ($id) {
                return !is_null($id) && is_numeric($id);
            });

            $agendado->adicional()->sync($validAdicionalIds);
        } else {
            $agendado->adicional()->detach();
        }

        return redirect()->route('agendado.index')->with('success', 'Reserva atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $agendado = Agendado::find($id);
        $user = Auth::user();

        if (!$agendado || ($agendado->usuario_id != $user->id && $agendado->anuncio->usuario_id != $user->id)) {
            return redirect()->route('agendado.index')->with('error', 'Reserva não encontrada.');
        }

        $agendado->delete();

        return redirect()->route('agendado.index')->with('success', 'Reserva cancelada com sucesso.');
    }
}
