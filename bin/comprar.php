<?php

require __DIR__ . '/../vendor/autoload.php';

use Tavares\CartaoDeBeneficios\Infrastructure\Repositories\CartaoRepositoryImpl;
use Tavares\CartaoDeBeneficios\Infrastructure\Repositories\TransacaoRepositoryImpl;
use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Presentation\Console\ComprarController;
use Tavares\CartaoDeBeneficios\Presentation\Presenters\ComprarPresenter;
use Tavares\CartaoDeBeneficios\Presentation\Presenters\ErroPresenter;

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

    $presenter = new ComprarPresenter();
    echo $presenter->format($resultado);
} catch (\Exception $e) {
    $erroPresenter = new ErroPresenter();
    echo $erroPresenter->format($e);
    exit(1);
}
