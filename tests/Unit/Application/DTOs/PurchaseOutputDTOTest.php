<?php

use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

it('armazena e expoe os dados de saida da compra', function () {
    $saldo = new Money(4000);
    $data = new DateTime();

    $dto = new PurchaseOutputDTO('uuid-123', $saldo, 'Padaria Central', $data);

    expect($dto->idTransacao)->toBe('uuid-123');
    expect($dto->saldoCartaoUtilizado)->toBe($saldo);
    expect($dto->estabelecimentoOndeOcorreuTransacao)->toBe('Padaria Central');
    expect($dto->dataDaTransacao)->toBe($data);
});
