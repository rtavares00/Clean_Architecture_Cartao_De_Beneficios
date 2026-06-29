<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Exceptions;

class CartaoNaoEncontradoException extends \RuntimeException
{
    public static function comId(int $id): self
    {
        return new self(
            sprintf(
                'Cartão com ID %d não foi encontrado no repositório.',
                $id
            )
        );
    }
}
