<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'min:10', 'max:15'],
            'datanasc' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Usuario::class)->ignore($this->user()->id)],
            'tipousu' => ['required', 'string', 'min:3', 'max:50'],
            'cpf' => ['required', 'string', 'size:11'],
            'cnpj' => ['nullable', 'string', 'min:14', 'max:14'],
            'cidade' => ['required', 'string', 'min:3', 'max:255'],
            'cep' => ['required', 'string', 'min:8', 'max:9'],
            'numero' => ['required', 'integer', 'min:1'],
            'bairro' => ['required', 'string', 'min:3', 'max:255']
        ];
    }
}
