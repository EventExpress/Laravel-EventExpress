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
        'categoria',
        'endereco_id',
        'capacidade',
        'descricao',
        'locador',
        'valor',
        'agenda',
        'status'
    ];

    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
    public function status() {
        return $this->belongsTo(Status::class);
    }
    
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function usuario() {
        return $this->hasMany(Usuario::class);
    }
    
    public function nome() {
        return $this->hasMany(Nome::class);
    }

}
