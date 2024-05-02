<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'titulo',
        'descricao',
        'valor',
        'disponibilidade',
        
    ];

    /**public function anuncio() {
        return $this->belongsTo(Anuncio::class);
    }*/

    /**public function categoria() {
        return $this->belongsTo(Categoria::class);
    }*/

}