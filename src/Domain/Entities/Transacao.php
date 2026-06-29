<?php

namespace Tavares\CartaoDeBeneficios\Domain\Entities;

use Ramsey\Uuid\Uuid;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\DataTransacaoInvalidaException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\EstabelecimentoInvalidoException;
use DateTime;

class Transacao
{
    private string $id;    

    public function __construct(
        //private int $id,
        private Money $valor,
        private string $estabelecimento,
        private DateTime $data
    )
    {
        if ($this->data->format('Y-m-d') !== date('Y-m-d')):
            throw DataTransacaoInvalidaException::deveSerDataDeHoje($data);
        endif;

        if (empty($this->estabelecimento)):
            throw EstabelecimentoInvalidoException::naoPoderSerNuloOuVazio();
        endif;

        $this->setId();
    }

    private function setId():void
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function id():string
    {
        return $this->id;
    }
}