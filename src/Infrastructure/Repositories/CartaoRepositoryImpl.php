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

        $data = json_decode(file_get_contents($this->filepath), true);
        $this->cartoes = $data['cartoes'];
    }

    public function buscar(int $id):Cartao
    {
        foreach ($this->cartoes as $cartao):
            if($cartao['id'] == $id):
                return new Cartao($id, new Money($cartao['saldo']), StatusCartao::from($cartao['statusCartao']));
            endif;
        endforeach;

        throw CartaoNaoEncontradoException::comId($id);
    }

    public function salvar(Cartao $cartao):void
    {
        for($c = 0; $c < count($this->cartoes); $c++)
        {
            $card = $this->cartoes[$c];
            if($card['id'] == $cartao->id()):
                array_splice($this->cartoes,$c,1);
            endif;
        }

        array_push( $this->cartoes, ["id" => $cartao->id() ,"saldo" => $cartao->saldo()->get() , "statusCartao" => $cartao->status()->value ] );
        
        file_put_contents($this->filepath, json_encode(['cartoes' => $this->cartoes], JSON_PRETTY_PRINT));
    }
}