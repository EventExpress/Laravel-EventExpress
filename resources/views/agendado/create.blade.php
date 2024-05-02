<div class="container">
    <h2>Reservar Anúncio</h2>
    <form  action="{{ route('agendado.store') }}" method="POST">
        @csrf
        <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
        <div class="form-group">
            <label for="data_inicio">Data de Início:</label>
            <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" required>
        </div>
        <div class="form-group">
            <label for="data_fim">Data de Fim:</label>
            <input type="datetime-local" class="form-control" id="data_fim" name="data_fim" required>
        </div>
        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>
</div>
