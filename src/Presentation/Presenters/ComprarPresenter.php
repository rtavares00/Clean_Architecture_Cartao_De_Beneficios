<?php

namespace Tavares\CartaoDeBeneficios\Presentation\Presenters;

use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;

class ComprarPresenter
{
    public function format(PurchaseOutputDTO $output): string
    {
        $saldoEmReais = number_format($output->saldoCartaoUtilizado->get() / 100, 2, ',', '.');

        return "Compra realizada com sucesso!\n"
            . "Transacao:     " . $output->idTransacao . "\n"
            . "Estabelecimento: " . $output->estabelecimentoOndeOcorreuTransacao . "\n"
            . "Data:          " . $output->dataDaTransacao->format('d/m/Y H:i:s') . "\n"
            . "Saldo restante: R$ " . $saldoEmReais . "\n";
    }
}
