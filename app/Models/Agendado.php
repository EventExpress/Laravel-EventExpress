<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendado extends Model
{   
    use HasFactory;
    protected $fillable = ['anuncio_id', 'usuario_id', 'data_inicio', 'data_fim'];

    public function anuncio()
    {
        return $this->belongsTo(Anuncio::class);
    }
    public function adicional()
    {
        return $this->belongsToMany(Adicional::class, 'agendado_adicional','agendado_id','adicional_id');
    }
    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

}
