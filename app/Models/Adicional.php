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
        
    ];
    public function agendado()
    {
        return $this->belongsToMany(Agendado::class, 'agendado_adicional','adicional_id','agendado_id');
    }
    /**public function anuncio() {
        return $this->belongsTo(Anuncio::class);
    }*/

    /**public function categoria() {
        return $this->belongsTo(Categoria::class);
    }*/

}