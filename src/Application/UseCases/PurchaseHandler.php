<?php
namespace Tavares\CartaoDeBeneficios\Application\UseCases;
use DateTime;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\CartaoRepository;
use Tavares\CartaoDeBeneficios\Application\Ports\Output\TransacaoRepository;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseInputDTO;
use Tavares\CartaoDeBeneficios\Application\DTOs\PurchaseOutputDTO;
class PurchaseHandler{

    public function __construct(
        private CartaoRepository $cartaoRepository,
        private TransacaoRepository $transacaoRepository
    ){}

    public function execute(PurchaseInputDTO $input):PurchaseOutputDTO
    {
        $cartao = $this->cartaoRepository->buscar($input->cartaoId);
        $transacao = $cartao->comprar($input->valor,$input->estabelecimento);
        $this->cartaoRepository->salvar($cartao);
        $this->transacaoRepository->salvar($transacao);

        return new PurchaseOutputDTO(
            $transacao->id(),
            $cartao->saldo(),
            $input->estabelecimento,
            new DateTime( date("Y-m-d H:i:s") )
        );

    }

}