<?php

require __DIR__ . '/../vendor/autoload.php';

use Tavares\CartaoDeBeneficios\Infrastructure\Repositories\CartaoRepositoryImpl;
use Tavares\CartaoDeBeneficios\Infrastructure\Repositories\TransacaoRepositoryImpl;
use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Presentation\Console\ComprarController;

if ($argc < 4):
    echo "Uso: php bin/comprar.php <cartaoId> <valorEmCentavos> <estabelecimento>\n";
    exit(1);
endif;

$cartaoId = (int) $argv[1];
$valorEmCentavos = (int) $argv[2];
$estabelecimento = $argv[3];

$controller = new ComprarController(
    new PurchaseHandler(
        new CartaoRepositoryImpl(),
        new TransacaoRepositoryImpl()
    )
);

try {
    $resultado = $controller->comprar($cartaoId, $valorEmCentavos, $estabelecimento);

    echo "Compra realizada com sucesso!\n";
    echo "Transacao: " . $resultado->idTransacao . "\n";
    echo "Saldo restante: " . $resultado->saldoCartaoUtilizado->get() . " centavos\n";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
    exit(1);
}
