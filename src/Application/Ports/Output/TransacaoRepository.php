<?php

namespace Tavares\CartaoDeBeneficios\Application\Ports\Output;
use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;

interface TransacaoRepository
{
    public function buscar(string $id):Transacao;

    public function salvar(Transacao $transacao):void;
}