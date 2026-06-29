<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Exceptions;

class PersistenceFileNotFoundException extends \RuntimeException
{
    public static function arquivoNaoEncontrado(string $filepath): self
    {
        return new self(
            sprintf(
                'Arquivo de persistência não encontrado ou não pode ser lido: %s',
                $filepath
            )
        );
    }
}
