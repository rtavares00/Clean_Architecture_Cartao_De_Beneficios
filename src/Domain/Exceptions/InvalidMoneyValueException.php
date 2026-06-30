<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

class InvalidMoneyValueException extends \DomainException
{
    public static function forNegativeAmount(int $cents): self
    {
        return new self(
            sprintf(
                'O valor monetário não pode ser negativo. Recebido: %d centavos.',
                $cents
            )
        );
    }
}
