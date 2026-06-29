<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Repositories;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\CartaoRepository;
use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;

class CartaoRepositoryImpl implements CartaoRepository
{
    private string $filepath;
    private array $cartoes;
    public function __construct(){
        $this->filepath = __DIR__ . '/../Persistence/cartoes.json';
    }

    public function buscar(int $id):Cartao
    {

    }

    public function salvar(Cartao $cartao):void
    {

    }
}