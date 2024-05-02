<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'titulo',
        'endereco_id',
        'capacidade',
        'descricao',
        'usuario_id',
        'valor',
        'agenda',
    ];

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    public function nome() {
        return $this->hasMany(Nome::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }

}
