<?php

namespace Tavares\CartaoDeBeneficios\Presentation\CLI;

use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseInputDTO;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;

class ComprarCartaoCLI
{
    public function __construct(private PurchaseHandler $purchaseHandler)
    {
    }

    public function __invoke(): void
    {
        echo "=== Compra com Cartão de Benefícios ===\n";
        echo "Digite o ID do cartão: ";
        $cartaoId = (int) trim(fgets(STDIN));

        echo "Digite o valor em centavos: ";
        $valorCentavos = (int) trim(fgets(STDIN));

        echo "Digite o estabelecimento: ";
        $estabelecimento = trim(fgets(STDIN));

        try {
            $input = new PurchaseInputDTO(
                $cartaoId,
                new Money($valorCentavos),
                $estabelecimento
            );

            $output = $this->purchaseHandler->execute($input);

            echo "\n✓ Compra realizada com sucesso!\n";
            echo "ID da Transação: " . $output->idTransacao . "\n";
            echo "Saldo utilizado: " . ($output->saldoCartaoUtilizado->get() / 100) . " reais\n";
            echo "Estabelecimento: " . $output->estabelecimentoOndeOcorreuTransacao . "\n";
            echo "Data: " . $output->dataDaTransacao->format('d/m/Y H:i:s') . "\n";
        } catch (\Exception $e) {
            echo "\n✗ Erro na compra: " . $e->getMessage() . "\n";
        }
    }
}
