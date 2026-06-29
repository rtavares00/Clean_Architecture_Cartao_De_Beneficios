<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

class CartaoBloqueadoException extends \DomainException
{
    public static function cartaoNaoPodeSerBloqueado(): self
    {
        return new self(
            'Não é permitido criar um cartão com status bloqueado. '
            . 'Um cartão deve ser criado com status ativo.'
        );
    }
}
