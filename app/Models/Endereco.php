<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'id',
        'cidade',
        'cep',
        'numero',
        'bairro'
    ];

    public function usuario() {
        return $this->hasMany(Usuario::class);
    }

    public function anuncio() {
        return $this->hasMany(Anuncio::class);
    }
}
