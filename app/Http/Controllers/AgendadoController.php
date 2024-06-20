<?php

namespace App\Http\Controllers;


use App\Models\Agendado;
use App\Models\Adicional;
use App\Models\Anuncio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendadoController extends Controller
{
    public function index()
    {
        $agendado = Agendado::all();
        $user = Auth::user();

        //se o usuario for cliente, mostrara as suas reservas
        if ($user->tipousu === 'Cliente') {
            $agendado = Agendado::where('usuario_id', $user->id)->get();
        } 
        //se o usario for locador, mostrara as reservas dos anuncios
        else if ($user->tipousu === 'Locador') {
            $agendado = Agendado::whereHas('anuncio', function ($query) use ($user) {
                $query->where('usuario_id', $user->id);
            })->get();
        }
        return view('agendado.index', ['agendado' => $agendado]);
    }

    /**
     * Mostra o formulário para criar um novo agendado para um anúncio específico.
     */
    public function create($anuncioId)
    {
        $user = Auth::user();

        // Verifica se o usuário autenticado é um Locador
        if ($user->tipousu !== 'Cliente') {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para criar anúncios.');
        }

        $anuncio = Anuncio::find($anuncioId);
        $adicional = Adicional::all();
        if (!$anuncio) {
            return redirect()->route('anuncio.index')->with('error', 'Anúncio não encontrado.');
        }

        // Verifica se o anúncio já está reservado
        $reservaExistente = Agendado::where('anuncio_id', $anuncioId)->first();
        if ($reservaExistente) {
            return redirect()->route('anuncio.index')->with('error', 'Este anúncio já está reservado.');
        }

        return view('agendado.create', ['anuncio' => $anuncio, 'adicional' => $adicional]);
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
            'adicionalId' => 'nullable|array',
        ]);

        $dataInicio = Carbon::parse($request->data_inicio)->toDateTimeString();
        $dataFim = Carbon::parse($request->data_fim)->toDateTimeString();

        // Verifica se o anúncio já está reservado
        $reservaExistente = Agendado::where('anuncio_id', $request->anuncio_id)->first();
        if ($reservaExistente) {
            return redirect()->route('anuncio.index')->with('error', 'Este anúncio já está reservado.');
        }

        $agendado = new Agendado();
        $agendado->anuncio_id = $request->anuncio_id;
        $agendado->usuario_id = Auth::id(); // Atribui a reserva ao usuário logado
        $agendado->data_inicio = $dataInicio;
        $agendado->data_fim = $dataFim;
        $agendado->save();
        if ($request->has('adicionalId') && is_array($request->adicionalId)) {
            // Filtra os IDs válidos para evitar valores nulos ou inválidos
            $validAdicionalIds = array_filter($request->adicionalId, function ($id) {
                return !is_null($id) && is_numeric($id);
            });
    
            if (!empty($validAdicionalIds)) {
                $agendado->adicional()->attach($validAdicionalIds);
            }
        }

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
        $user = Auth::user();

        if (!$agendado || $agendado->usuario_id != $user->id) {
            return redirect()->route('agendado.index')->with('Reserva não encontrada.');
        }
        $adicional = Adicional::all();

        // Obter os IDs dos adicionais associados ao agendamento
        $adicionaisSelecionados = $agendado->adicional->pluck('id')->toArray();

        return view('agendado.edit', [
        'agendado' => $agendado,
        'adicional' => $adicional,
        'adicionaisSelecionados' => $adicionaisSelecionados,
        ]);
    }

    /**
     * Atualiza um agendado existente no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'adicionalId' => 'nullable|array',
        ]);

        $agendado = Agendado::find($id);
        $user = Auth::user();

        if (!$agendado || $agendado->usuario_id != $user->id) {
            return redirect()->route('agendado.index')->with('Reserva não encontrada.');
        }

        $agendado->data_inicio = $request->data_inicio;
        $agendado->data_fim = $request->data_fim;
        $adicionalId = $request->adicionalId;
        $agendado->save();

        if ($request->has('adicionalId') && is_array($request->adicionalId)) {
            // Filtra os IDs válidos para evitar valores nulos ou inválidos
            $validAdicionalIds = array_filter($request->adicionalId, function ($id) {
                return !is_null($id) && is_numeric($id);
            });
    
            $agendado->adicional()->sync($validAdicionalIds);
        } else {
            $agendado->adicional()->detach();
        }

        return redirect()->route('agendado.index')->with('Reserva atualizada com sucesso.');
    }

    /**
     * Remove um agendado do banco de dados.
     */
    public function destroy($id)
    {
        $agendado = Agendado::find($id);
        $user = Auth::user();

        if (!$agendado || ($agendado->usuario_id != $user->id && $agendado->anuncio->usuario_id != $user->id)) {
            return redirect()->route('agendado.index')->with('Reserva não encontrada.');
        }

        $agendado->delete();

        return redirect()->route('agendado.index')->with('Reserva cancelada com sucesso.');
    }
}
