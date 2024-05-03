<div class="container">
    <h2>Editar Reserva</h2>
    <form method="POST" action="{{ route('agendado.update', $agendado->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="data_inicio">Data de Início:</label>
            <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $agendado->data_inicio) }}" required>
        </div>
        <div class="form-group">
            <label for="data_fim">Data de Fim:</label>
            <input type="datetime-local" class="form-control" id="data_fim" name="data_fim" value="{{ old('data_fim', $agendado->data_fim) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
