<?php

namespace Tavares\CartaoDeBeneficios\Domain\Exceptions;

use DateTime;

class DataTransacaoInvalidaException extends \DomainException
{
    public static function deveSerDataDeHoje(DateTime $dataRecebida): self
    {
        return new self(
            sprintf(
                'A data da transação deve ser a data de hoje. Data recebida: %s.',
                $dataRecebida->format('d/m/Y H:i:s')
            )
        );
    }
}
