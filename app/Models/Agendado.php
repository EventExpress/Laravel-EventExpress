<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendado extends Model
{   
    use HasFactory;
    protected $fillable = ['anuncio_id', 'data_inicio', 'data_fim', 'confirmado'];

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }

}
