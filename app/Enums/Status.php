<?php

namespace App\Enums;

enum categoria : string
{
    const PENDENTE = 'pendente';
    const PROCESSANDO = 'processando';
    const PAGO = 'pago';
    const CANCELADO = 'cancelado';
}