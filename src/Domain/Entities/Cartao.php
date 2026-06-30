<?php

namespace Tavares\CartaoDeBeneficios\Domain\Entities;

use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Enums\StatusCartao;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\CartaoBloqueadoException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\InvalidCompraValueException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\SaldoInsuficienteException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\CartaoBloqueadoParaOperacaoException;
use DateTime;
use Ramsey\Uuid\Uuid;

class Cartao
{
    public function __construct(
        private int $id,
        private Money $saldo,
        private StatusCartao $statusCartao
    ) {
        //if ($this->statusCartao === StatusCartao::Bloqueado) {
        //    throw CartaoBloqueadoException::cartaoNaoPodeSerBloqueado();
        //}
    }

    public function id():int
    {
        return $this->id;
    }

    public function saldo():Money
    {
        return $this->saldo;
    }

    public function status()
    {
        return $this->statusCartao;
    }

    public function comprar(Money $valorDaCompra,string $estabelecimento):Transacao
    {
        if ($valorDaCompra->isGreaterThan($this->saldo)):
            throw SaldoInsuficienteException::paraRealizarCompra($this->saldo, $valorDaCompra);
        endif;

        if ($this->statusCartao === StatusCartao::Bloqueado):
            throw CartaoBloqueadoParaOperacaoException::naoEhPossivelRealizarOperacao();
        endif;

        $this->saldo = $this->saldo->subtract($valorDaCompra);
        
        $transacao = new Transacao(Uuid::uuid4()->toString(),$valorDaCompra,$estabelecimento,new DateTime(date("Y-m-d")));
        return $transacao;
    }
}