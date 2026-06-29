<?php

namespace Tavares\CartaoDeBeneficios\Application\Ports\Output;
use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;

interface CartaoRepository
{
    public function buscar(int $id):Cartao;

    public function salvar(Cartao $cartao):void;
}