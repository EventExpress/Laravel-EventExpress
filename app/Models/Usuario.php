<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable=['nome_id','telefone','email','datanasc','tipousu','cpf','cnpj','endereco_id'];

    public function nome() {
        return $this->belongsTo(Nome::class);
    }
    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
    public function anuncio() {
        return $this->belongsTo(Anuncio::class);
    }
}
