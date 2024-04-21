<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable=['nome','telefone','email','datanasc','tipousu','cpf','cnpj','endereco'];

    public function nome() {
        return $this->hasMany(Nome::class);
    }
}
