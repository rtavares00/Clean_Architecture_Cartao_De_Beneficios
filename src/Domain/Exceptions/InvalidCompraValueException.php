<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

class InvalidCompraValueException extends \DomainException
{
    public static function valorDaCompraPrecisaSuperiorAZero(int $cents): self
    {
        return new self(
            sprintf(
                'O valor da compra deve ser superior a zero. Valor recebido: %d centavos.',
                $cents
            )
        );
    }
}
