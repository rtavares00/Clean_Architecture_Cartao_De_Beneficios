<?php

use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseInputDTO;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

it('armazena e expoe os dados de entrada da compra', function () {
    $valor = new Money(5000);

    $dto = new PurchaseInputDTO(1, $valor, 'Padaria Central');

    expect($dto->cartaoId)->toBe(1);
    expect($dto->valor)->toBe($valor);
    expect($dto->estabelecimento)->toBe('Padaria Central');
});
