<?php

use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\DataTransacaoInvalidaException;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\EstabelecimentoInvalidoException;

it('cria uma Transacao valida e expoe os dados pelos getters', function () {
    $valor = new Money(5000);
    $data = new DateTime();

    $transacao = new Transacao('uuid-123', $valor, 'Padaria Central', $data);

    expect($transacao->id())->toBe('uuid-123');
    expect($transacao->valor())->toBe($valor);
    expect($transacao->estabelecimento())->toBe('Padaria Central');
    expect($transacao->data())->toBe($data);
});

it('lanca excecao quando a data nao e a data de hoje', function () {
    $dataAntiga = new DateTime('2020-01-01');

    expect(fn () => new Transacao('uuid-123', new Money(5000), 'Padaria', $dataAntiga))
        ->toThrow(DataTransacaoInvalidaException::class);
});

it('lanca excecao quando o estabelecimento e vazio', function () {
    expect(fn () => new Transacao('uuid-123', new Money(5000), '', new DateTime()))
        ->toThrow(EstabelecimentoInvalidoException::class);
});
