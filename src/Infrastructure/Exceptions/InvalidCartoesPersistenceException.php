<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Exceptions;

class InvalidCartoesPersistenceException extends \RuntimeException
{
    public static function dataFormatInvalid(): self
    {
        return new self(
            'Formato de dados de cartões inválido ou vazio. '
            . 'Esperado: array não vazio com propriedade "cartoes".'
        );
    }
}
