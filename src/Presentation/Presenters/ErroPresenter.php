<?php

namespace Tavares\CartaoDeBeneficios\Presentation\Presenters;

use Throwable;

class ErroPresenter
{
    public function format(Throwable $erro): string
    {
        return "Erro: " . $erro->getMessage() . "\n";
    }
}
