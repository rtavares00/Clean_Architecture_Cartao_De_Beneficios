<?php

require __DIR__ . '/../vendor/autoload.php';

use Tavares\CartaoDeBeneficios\Infrastructure\Repositories\CartaoRepositoryImpl;
use Tavares\CartaoDeBeneficios\Infrastructure\Repositories\TransacaoRepositoryImpl;
use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Presentation\CLI\ComprarCartaoCLI;

try {
    $cartaoRepository = new CartaoRepositoryImpl();
    $transacaoRepository = new TransacaoRepositoryImpl();

    $purchaseHandler = new PurchaseHandler(
        $cartaoRepository,
        $transacaoRepository
    );

    $cli = new ComprarCartaoCLI($purchaseHandler);
    $cli();
} catch (\Exception $e) {
    echo "Erro fatal: " . $e->getMessage() . "\n";
    exit(1);
}
