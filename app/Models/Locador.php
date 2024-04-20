<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locador extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'cnpj',
        'endereco',
    ];
}
