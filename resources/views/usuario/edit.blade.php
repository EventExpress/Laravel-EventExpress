<div>
    <form action="{{ url("/usuario/$usuario->id") }}" method="POST">
        @method("PUT")
        <h1 class="text-xl font-bold mb-4">Editar Tarefa</h1>
        <label for="nome">
            Nome
        </label>
        <input type="text" name="nome" id="nome" value="{{$usuario->nome}}">
</div>
<div>
    <label for="telefone">
        Telefone
    </label>
    <input type="text" name="telefone" id="telefone" maxlength="12" value="{{$usuario->telefone}}">
</div>
<div>
    <label for="email">
        E-mail
    </label>
    <input type="email" name="email" id="email" value="{{$usuario->email}}">
</div>
<div>
    <div>
        <label for="datanasc">
            Data de Nascimento
        </label>
        <input type="date" name="datanasc" id="datanasc" value="{{$usuario->datanasc}}">
    </div>
    <label for="cpf">
        CPF
    </label>
    <input type="text" name="cpf" id="cpf" maxlength="14" value="{{$usuario->cpf}}">
    <div>
        <input type="submit" value="Editar">
    </div>
</div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
</div>

