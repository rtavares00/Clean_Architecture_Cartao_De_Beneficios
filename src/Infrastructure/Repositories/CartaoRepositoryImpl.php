<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Repositories;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\CartaoRepository;
use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;
use Tavares\CartaoDeBeneficios\Infrastructure\Exceptions\PersistenceFileNotFoundException;

class CartaoRepositoryImpl implements CartaoRepository
{
    private string $filepath;
    private array $cartoes;
    public function __construct(){
        
        $this->filepath = __DIR__ . '/../Persistence/cartoes.json';
        
        if(file_get_contents($this->filepath) == false):
            throw PersistenceFileNotFoundException::arquivoNaoEncontrado($this->filepath);
        endif;

        $this->cartoes = json_deco
    }

    public function buscar(int $id):Cartao
    {

    }

    public function salvar(Cartao $cartao):void
    {

    }
}