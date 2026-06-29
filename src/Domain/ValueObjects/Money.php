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

    public function equals(Money $other):bool
    {
        return $this->cents === $other->get();
    }

    public function isGreaterThan(Money $other):bool
    {
        return $this->cents > $other->get();
    }
    
    public function subtract(Money $other):self
    {
        return new self($this->cents - $other->get());
    }

    public function get():int
    {
        return $this->cents;
    }
}