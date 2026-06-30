<?php

namespace Tavares\CartaoDeBeneficios\Presentation\Console;

use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseInputDTO;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

class ComprarController
{
    public function __construct(private PurchaseHandler $purchaseHandler)
    {
    }

    public function comprar(int $cartaoId, int $valorEmCentavos, string $estabelecimento): PurchaseOutputDTO
    {
        $input = new PurchaseInputDTO(
            $cartaoId,
            new Money($valorEmCentavos),
            $estabelecimento
        );

        return $this->purchaseHandler->execute($input);
    }
}