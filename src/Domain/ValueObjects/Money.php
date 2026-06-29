<?php

namespace Tavares\CartaoDeBeneficios\Domain\ValueObjects;

use Tavares\CartaoDeBeneficios\Domain\Exceptions\InvalidMoneyValueException;

class Money
{
    public function __construct(private int $cents)
    {
        if ($cents <= 0) {
            throw InvalidMoneyValueException::forNegativeOrZeroAmount($cents);
        }
    }

    public function equals(Money $cents)
    {
        
    }
}