<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $fillable=[
        'nome_id',
        'telefone',
        'email',
        'password',
        'remember_token',
        'datanasc',
        'tipousu',
        'cpf',
        'cnpj',
        'endereco_id'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function nome() {
        return $this->belongsTo(Nome::class);
    }
    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
    public function anuncio() {
        return $this->hasMany(Anuncio::class);
    }
}
