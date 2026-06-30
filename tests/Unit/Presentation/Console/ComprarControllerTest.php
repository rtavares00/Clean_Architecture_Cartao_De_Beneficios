<?php

use Tavares\CartaoDeBeneficios\Presentation\Console\ComprarController;
use Tavares\CartaoDeBeneficios\Application\UseCases\PurchaseHandler;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\CartaoRepository;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\TransacaoRepository;
use Tavares\CartaoDeBeneficios\Domain\Entities\Cartao;
use Tavares\CartaoDeBeneficios\Domain\Entities\Transacao;
use Tavares\CartaoDeBeneficios\Domain\ValueObjects\Money;
use Tavares\CartaoDeBeneficios\Domain\Enums\StatusCartao;

it('adapta os dados crus, executa a compra e retorna o PurchaseOutputDTO', function () {
    $cartao = new Cartao(1, new Money(10000), StatusCartao::Ativo);

    $cartaoRepo = new class($cartao) implements CartaoRepository {
        public function __construct(private Cartao $cartao) {}
        public function buscar(int $id): Cartao { return $this->cartao; }
        public function salvar(Cartao $cartao): void {}
    };

    $transacaoRepo = new class implements TransacaoRepository {
        public function buscar(string $id): Transacao { throw new RuntimeException('nao usado'); }
        public function salvar(Transacao $transacao): void {}
    };

    $controller = new ComprarController(new PurchaseHandler($cartaoRepo, $transacaoRepo));

    $output = $controller->comprar(1, 3000, 'Padaria Central');

    expect($output)->toBeInstanceOf(PurchaseOutputDTO::class);
    expect($output->saldoCartaoUtilizado->get())->toBe(7000);
    expect($output->estabelecimentoOndeOcorreuTransacao)->toBe('Padaria Central');
});
