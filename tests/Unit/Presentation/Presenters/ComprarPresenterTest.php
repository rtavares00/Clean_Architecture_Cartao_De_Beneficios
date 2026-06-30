<?php

use Tavares\CartaoDeBeneficios\Presentation\Presenters\ComprarPresenter;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

it('formata o resultado da compra em texto legivel', function () {
    $output = new PurchaseOutputDTO(
        'uuid-123',
        new Money(32000),
        'Padaria Central',
        new DateTime('2026-06-30 14:32:52')
    );

    $texto = (new ComprarPresenter())->format($output);

    expect($texto)->toContain('Compra realizada com sucesso!');
    expect($texto)->toContain('uuid-123');
    expect($texto)->toContain('Padaria Central');
    expect($texto)->toContain('30/06/2026 14:32:52');
    expect($texto)->toContain('R$ 320,00');
});
