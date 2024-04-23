<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendados extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'id',
        'nome',
        'descricao'
    ];

    public function nome() {
        return $this->hasMany(Nome::class);
    }

    public function anuncio() {
        return $this->belongsTo(Anuncio::class);
    }
}
