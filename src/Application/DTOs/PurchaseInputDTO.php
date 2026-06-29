<?php

namespace Tavares\CartaoDeBeneficios\Application\DTOs;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

final readonly class PurchaseInputDTO
{
    public function __construct(
        public int $cartaoId,
        public Money $valor,
        public string $estabelecimento
    ){}
}