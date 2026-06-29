<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

class EstabelecimentoInvalidoException extends \DomainException
{
    public static function naoPoderSerNuloOuVazio(): self
    {
        return new self(
            'O estabelecimento não pode ser nulo ou vazio. '
            . 'Toda transação deve estar associada a um estabelecimento válido.'
        );
    }
}
