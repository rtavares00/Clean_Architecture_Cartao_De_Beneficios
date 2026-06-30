<?php

use Tavares\CartaoDeBeneficios\Domain\Enums\StatusCartao;

it('mapeia o valor "A" para o caso Ativo', function () {
    expect(StatusCartao::from('A'))->toBe(StatusCartao::Ativo);
});

it('mapeia o valor "B" para o caso Bloqueado', function () {
    expect(StatusCartao::from('B'))->toBe(StatusCartao::Bloqueado);
});

it('expoe o valor de cada caso via propriedade value', function () {
    expect(StatusCartao::Ativo->value)->toBe('A');
    expect(StatusCartao::Bloqueado->value)->toBe('B');
});
