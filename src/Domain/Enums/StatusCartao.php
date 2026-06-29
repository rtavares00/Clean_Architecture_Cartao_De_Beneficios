<?php

namespace Tavares\CartaoDeBeneficios\Domain\Enums;

enum StatusCartao: string
{
    case Ativo = 'A';
    case Bloqueado = 'B';
    //case Cancelado = 'cancelado';
}