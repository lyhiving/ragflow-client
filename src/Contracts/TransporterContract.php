<?php

declare(strict_types=1);

namespace RAGFlow\Contracts;

use RAGFlow\Exceptions\ErrorException;
use RAGFlow\Exceptions\TransporterException;
use RAGFlow\Exceptions\UnserializableResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
interface TransporterContract
{
    /**
     * Sends a request to a server.
     *
     * @return Response<array<array-key, mixed>|string>
     *
     * @throws ErrorException|UnserializableResponse|TransporterException
     */
    public function requestObject(Payload $payload): Response;

    /**
     * Sends a content request to a server.
     *
     * @throws ErrorException|TransporterException
     */
    public function requestContent(Payload $payload): string;

    /**
     * Sends a stream request to a server.
     **
     * @throws ErrorException
     */
    public function requestStream(Payload $payload): ResponseInterface;
}
