<?php

namespace App\Enums;

enum categoria : string
{
    const PENDENTE = 'Pendente';
    const PROCESSANDO = 'Processando';
    const PAGO = 'Pago';
    const CANCELADO = 'Cancelado';
    const RESERVADO = 'Reservado';
    const DISPONÍVEL = 'Disponivel';
}