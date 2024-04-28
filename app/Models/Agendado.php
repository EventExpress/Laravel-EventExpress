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
        'nome_id',
        'anuncio_id',
        'adicional_id',
        'contrato',
        'status',
    ];

    public function nome() {
        return $this->hasMany(Nome::class);
    }

    public function anuncio() {
        return $this->belongsTo(Anuncio::class);
    }

    public function adicional() {
        return $this->belongsTo(Adicional::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

}