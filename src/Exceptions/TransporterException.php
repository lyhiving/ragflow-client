<?php

declare(strict_types=1);

namespace RAGFlow\Exceptions;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;

final class TransporterException extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(ClientExceptionInterface $exception)
    {
        parent::__construct($exception->message(), 0, $exception);
    }
}
