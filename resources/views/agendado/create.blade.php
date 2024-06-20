<div class="container">
    <h2>Reservar Anúncio</h2>
    <form  action="/agendado" method="POST">
        @csrf
        <div class="form-group">
            <label for="data_inicio">Data de Início:</label>
            <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" required>
        </div>
        <div class="form-group">
            <label for="data_fim">Data de Fim:</label>
            <input type="datetime-local" class="form-control" id="data_fim" name="data_fim" required>
        </div>
        <div>
            <label for="adicionalId">Escolher adicionais</label>
                <select name="adicionalId[]" id="adicionalId">
                <option value="">Selecionar</option>
                @foreach($adicional as $adicionais)
                    <option value="{{ $adicionais->id }}">{{ $adicionais->titulo }} - R$ {{ $adicionais->valor }}</option>
                @endforeach
                </select>
        </div>
        <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
        <input type="hidden" name="usuario_id" value="{{ Auth::id() }}">

        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>
</div>
