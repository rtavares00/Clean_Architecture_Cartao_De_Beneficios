<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

class InvalidMoneyValueException extends \DomainException
{
    public static function forNegativeOrZeroAmount(int $cents): self
    {
        return new self(
            sprintf(
                'O valor monetário não pode ser negativo ou zero. Recebido: %d centavos.',
                $cents
            )
        );
    }
}
