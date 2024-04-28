<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendados extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'titulo',
        'anuncio_id',
        'categoria_id',
        'descricao',
        'valor',
        'disponibilidade',
        'status',
        
    ];

    public function anuncio() {
        return $this->belongsTo(Anuncio::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

}