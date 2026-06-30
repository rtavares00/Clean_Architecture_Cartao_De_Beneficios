<?php

use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseInputDTO;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\CartaoRepository;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\TransacaoRepository;
use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;
use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Enums\StatusCartao;

/*
 * Repositorios FAKE em memoria: implementam as interfaces (ports) sem tocar
 * em JSON. E exatamente isto que a inversao de dependencia possibilita:
 * trocar a infraestrutura real por uma dublê de teste.
 */
function fakeCartaoRepository(Cartao $cartao): CartaoRepository
{
    return new class($cartao) implements CartaoRepository {
        public ?Cartao $cartaoSalvo = null;

        public function __construct(private Cartao $cartao) {}

        public function buscar(int $id): Cartao
        {
            return $this->cartao;
        }

        public function salvar(Cartao $cartao): void
        {
            $this->cartaoSalvo = $cartao;
        }
    };
}

function fakeTransacaoRepository(): TransacaoRepository
{
    return new class implements TransacaoRepository {
        public ?Transacao $transacaoSalva = null;

        public function buscar(string $id): Transacao
        {
            throw new RuntimeException('buscar nao deve ser chamado neste fluxo');
        }

        public function salvar(Transacao $transacao): void
        {
            $this->transacaoSalva = $transacao;
        }
    };
}

it('executa a compra retornando um PurchaseOutputDTO com o saldo debitado', function () {
    $cartao = new Cartao(1, new Money(10000), StatusCartao::Ativo);
    $cartaoRepo = fakeCartaoRepository($cartao);
    $transacaoRepo = fakeTransacaoRepository();

    $handler = new PurchaseHandler($cartaoRepo, $transacaoRepo);

    $output = $handler->execute(new PurchaseInputDTO(1, new Money(3000), 'Padaria Central'));

    expect($output)->toBeInstanceOf(PurchaseOutputDTO::class);
    expect($output->saldoCartaoUtilizado->get())->toBe(7000);
    expect($output->estabelecimentoOndeOcorreuTransacao)->toBe('Padaria Central');
});

it('persiste o cartao atualizado e a transacao gerada', function () {
    $cartao = new Cartao(1, new Money(10000), StatusCartao::Ativo);
    $cartaoRepo = fakeCartaoRepository($cartao);
    $transacaoRepo = fakeTransacaoRepository();

    $handler = new PurchaseHandler($cartaoRepo, $transacaoRepo);

    $output = $handler->execute(new PurchaseInputDTO(1, new Money(3000), 'Padaria Central'));

    expect($cartaoRepo->cartaoSalvo)->toBe($cartao);
    expect($transacaoRepo->transacaoSalva)->toBeInstanceOf(Transacao::class);
    expect($output->idTransacao)->toBe($transacaoRepo->transacaoSalva->id());
});
