<?php

declare(strict_types=1);

namespace RAGFlow\Exceptions;

use Exception;
use JsonException;

final class UnserializableResponse extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->message(), 0, $exception);
    }
}
