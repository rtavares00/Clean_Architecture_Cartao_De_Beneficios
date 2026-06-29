<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Repositories;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\CartaoRepository;
use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Enums\StatusCartao;
use Tavares\CartaoDeBeneficios\Infrastructure\Exceptions\PersistenceFileNotFoundException;
use Tavares\CartaoDeBeneficios\Infrastructure\Exceptions\CartaoNaoEncontradoException;

class CartaoRepositoryImpl implements CartaoRepository
{
    private string $filepath;
    private array $cartoes;

    public function __construct(){
        
        $this->filepath = __DIR__ . '/../Persistence/cartoes.json';
        
        if(file_get_contents($this->filepath) == false):
            throw PersistenceFileNotFoundException::arquivoNaoEncontrado($this->filepath);
        endif;

        $this->cartoes = json_decode( file_get_contents($this->filepath) );
    }

    public function buscar(int $id):Cartao
    {
        foreach ($this->cartoes as $cartao):
            if($cartao->id == $id):
                return new Cartao($id, new   , StatusCartao $statusCartao);
            endif;
        endforeach;

        throw CartaoNaoEncontradoException::comId($id);
    }

    public function salvar(Cartao $cartao):void
    {

    }
}