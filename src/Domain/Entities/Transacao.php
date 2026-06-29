<?php

namespace Tavares\CartaoDeBeneficios\Domain\Entities;

use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\DataTransacaoInvalidaException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\EstabelecimentoInvalidoException;
use DateTime;

class Transacao
{
    public function __construct(
        private int $id,
        private Money $valor,
        private string $estabelecimento,
        private DateTime $data
    )
    {
        if ($this->data->format('Y-m-d') !== date('Y-m-d')):
            throw DataTransacaoInvalidaException::deveSerDataDeHoje($data);
        endif;

        if (empty($this->estabelecimento)) {
            throw EstabelecimentoInvalidoException::naoPoderSerNuloOuVazio();
        }
    }
}