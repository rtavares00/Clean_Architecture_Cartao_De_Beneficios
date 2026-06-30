<?php

use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Exceptions\InvalidMoneyValueException;

it('cria um Money com valor positivo e expoe o valor via get', function () {
    $money = new Money(5000);

    expect($money->get())->toBe(5000);
});

it('aceita o valor zero (saldo zerado e um valor monetario legitimo)', function () {
    expect((new Money(0))->get())->toBe(0);
});

it('lanca excecao ao criar Money com valor negativo', function () {
    expect(fn () => new Money(-100))->toThrow(InvalidMoneyValueException::class);
});

it('permite subtrair ate zerar sem lancar excecao', function () {
    expect((new Money(100))->subtract(new Money(100))->get())->toBe(0);
});

it('considera iguais dois Money com o mesmo valor', function () {
    expect((new Money(5000))->equals(new Money(5000)))->toBeTrue();
});

it('considera diferentes dois Money com valores distintos', function () {
    expect((new Money(5000))->equals(new Money(3000)))->toBeFalse();
});

it('identifica quando um Money e maior que outro', function () {
    expect((new Money(5000))->isGreaterThan(new Money(3000)))->toBeTrue();
    expect((new Money(3000))->isGreaterThan(new Money(5000)))->toBeFalse();
});

it('subtrai dois Money retornando uma nova instancia com a diferenca', function () {
    $resultado = (new Money(5000))->subtract(new Money(2000));

    expect($resultado->get())->toBe(3000);
});
