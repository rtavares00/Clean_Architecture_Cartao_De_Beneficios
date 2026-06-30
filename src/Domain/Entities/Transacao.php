<?php

namespace Tavares\CartaoDeBeneficios\Domain\Entities;

use Ramsey\Uuid\Uuid;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\EstabelecimentoInvalidoException;
use DateTime;

class Transacao
{
    public function __construct(
        private string $id,
        private Money $valor,
        private string $estabelecimento,
        private DateTime $data
    )
    {
        if (empty($this->estabelecimento)):
            throw EstabelecimentoInvalidoException::naoPoderSerNuloOuVazio();
        endif;
    }

    public static function criar(Money $valor, string $estabelecimento): self
    {
        return new self(
            Uuid::uuid4()->toString(),
            $valor,
            $estabelecimento,
            new DateTime()
        );
    }

    public function id():string
    {
        return $this->id;
    }

    public function valor():Money
    {
        return $this->valor;
    }

    public function estabelecimento():string
    {
        return $this->estabelecimento;
    }

    public function data():DateTime
    {
        return $this->data;
    }
}