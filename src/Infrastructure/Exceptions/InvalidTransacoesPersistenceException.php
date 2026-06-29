<?php

namespace Tavares\CartaoDeBeneficios\Infrastructure\Exceptions;

class InvalidTransacoesPersistenceException extends \RuntimeException
{
    public static function dataFormatInvalid(): self
    {
        return new self(
            'Formato de dados de transações inválido ou vazio. '
            . 'Esperado: array não vazio com propriedade "transacoes".'
        );
    }
}
