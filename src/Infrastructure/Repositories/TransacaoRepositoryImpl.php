<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Repositories;
use DateTime;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\TransacaoRepository;
use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Infrastructure\Exceptions\PersistenceFileNotFoundException;
use Tavares\CartaoDeBeneficios\Infrastructure\Exceptions\InvalidTransacoesPersistenceException;
use Tavares\CartaoDeBeneficios\Infrastructure\Exceptions\TransacaoNaoEncontradaException;

Class TransacaoRepositoryImpl implements TransacaoRepository
{
    private string $filepath;
    private array $transacoes;

    public function __construct()
    {
        
        $this->filepath = __DIR__ . '/../Persistence/transacoes.json';
        
        if(file_get_contents($this->filepath) == false):
            throw PersistenceFileNotFoundException::arquivoNaoEncontrado($this->filepath);
        endif;

        $data = json_decode(file_get_contents($this->filepath), true);

        if (!is_array($data['transacoes']) || empty($data['transacoes'])) {
            throw InvalidTransacoesPersistenceException::dataFormatInvalid();
        }

        $this->transacoes = $data['transacoes'];
    }

    public function buscar(string $id):Transacao
    {
        foreach ($this->transacoes as $transacao):
            if($transacao['id'] == $id):
                /*
                    public function __construct(
                        //private int $id,
                        private Money $valor,
                        private string $estabelecimento,
                        private DateTime $data
                    )
                */
                $objTransacao = new Transacao( $transacao['id']  ,new Money($transacao['valor']) , $transacao['estabelecimento'] , new DateTime($transacao['data']) );
                return $objTransacao;
            endif;
        endforeach;

        throw TransacaoNaoEncontradaException::comId($id);
    }
}
