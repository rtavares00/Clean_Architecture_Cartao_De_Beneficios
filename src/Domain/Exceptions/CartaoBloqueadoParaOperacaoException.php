<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

class CartaoBloqueadoParaOperacaoException extends \DomainException
{
    public static function naoEhPossivelRealizarOperacao(): self
    {
        return new self(
            'O cartão está bloqueado e não é possível realizar operações. '
            . 'Desbloqueie o cartão para continuar.'
        );
    }
}
