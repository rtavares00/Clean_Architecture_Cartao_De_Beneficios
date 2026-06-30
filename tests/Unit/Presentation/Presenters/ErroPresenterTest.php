<?php

use Tavares\CartaoDeBeneficios\Presentation\Presenters\ErroPresenter;

it('formata a mensagem de erro a partir de um Throwable', function () {
    $texto = (new ErroPresenter())->format(new RuntimeException('algo deu errado'));

    expect($texto)->toBe("Erro: algo deu errado\n");
});
