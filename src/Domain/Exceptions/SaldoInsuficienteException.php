<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

class SaldoInsuficienteException extends \DomainException
{
    public static function paraRealizarCompra(Money $saldo, Money $valorSolicitado): self
    {
        return new self(
            sprintf(
                'Saldo insuficiente para realizar a compra. Saldo disponível: %d centavos. '
                . 'Valor solicitado: %d centavos.',
                $saldo->get(),
                $valorSolicitado->get()
            )
        );
    }
}
