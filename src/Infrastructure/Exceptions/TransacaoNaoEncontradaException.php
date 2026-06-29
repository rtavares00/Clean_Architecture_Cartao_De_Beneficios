<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Exceptions;

class TransacaoNaoEncontradaException extends \RuntimeException
{
    public static function comId(string $id): self
    {
        return new self(
            sprintf(
                'Transação com ID %s não foi encontrada no repositório.',
                $id
            )
        );
    }
}
