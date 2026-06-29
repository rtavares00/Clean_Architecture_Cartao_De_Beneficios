<?php

namespace Tavares\CartaoDeBeneficios\Application\DTOs;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
final readonly class PurchaseOutputDTO
{
    public function __construct(
        public string $idTransacao,
        public Money $saldoCartaoUtilizado,
        public string $estabelecimentoOndeOcorreuTransacao,
        public DateTime $dataDaTransacao
    ){}
}