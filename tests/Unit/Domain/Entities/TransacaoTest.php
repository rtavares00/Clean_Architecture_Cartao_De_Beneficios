<?php

use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\EstabelecimentoInvalidoException;

it('reconstitui uma Transacao (construtor) com qualquer data, inclusive passada', function () {
    $valor = new Money(5000);
    $dataPassada = new DateTime('2020-01-01 10:00:00');

    $transacao = new Transacao('uuid-123', $valor, 'Padaria Central', $dataPassada);

    expect($transacao->id())->toBe('uuid-123');
    expect($transacao->valor())->toBe($valor);
    expect($transacao->estabelecimento())->toBe('Padaria Central');
    expect($transacao->data())->toBe($dataPassada);
});

it('cria uma nova Transacao (factory) gerando id e data atual', function () {
    $transacao = Transacao::criar(new Money(5000), 'Padaria Central');

    expect($transacao->id())->not->toBeEmpty();
    expect($transacao->estabelecimento())->toBe('Padaria Central');
    expect($transacao->data()->format('Y-m-d'))->toBe(date('Y-m-d'));
});

it('lanca excecao quando o estabelecimento e vazio', function () {
    expect(fn () => new Transacao('uuid-123', new Money(5000), '', new DateTime()))
        ->toThrow(EstabelecimentoInvalidoException::class);
});
