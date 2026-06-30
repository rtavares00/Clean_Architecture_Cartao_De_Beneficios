<?php

use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;
use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Enums\StatusCartao;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\SaldoInsuficienteException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\CartaoBloqueadoParaOperacaoException;

it('expoe id, saldo e status pelos getters', function () {
    $cartao = new Cartao(7, new Money(5000), StatusCartao::Ativo);

    expect($cartao->id())->toBe(7);
    expect($cartao->saldo()->get())->toBe(5000);
    expect($cartao->status())->toBe(StatusCartao::Ativo);
});

it('realiza uma compra debitando o saldo e gerando uma Transacao', function () {
    $cartao = new Cartao(1, new Money(10000), StatusCartao::Ativo);

    $transacao = $cartao->comprar(new Money(3000), 'Padaria Central');

    expect($transacao)->toBeInstanceOf(Transacao::class);
    expect($cartao->saldo()->get())->toBe(7000);
});

it('lanca excecao ao comprar com saldo insuficiente', function () {
    $cartao = new Cartao(1, new Money(1000), StatusCartao::Ativo);

    expect(fn () => $cartao->comprar(new Money(5000), 'Padaria'))
        ->toThrow(SaldoInsuficienteException::class);
});

it('lanca excecao ao comprar com cartao bloqueado', function () {
    $cartao = new Cartao(1, new Money(10000), StatusCartao::Bloqueado);

    expect(fn () => $cartao->comprar(new Money(3000), 'Padaria'))
        ->toThrow(CartaoBloqueadoParaOperacaoException::class);
});
