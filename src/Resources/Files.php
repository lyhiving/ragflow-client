<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\FilesContract;
use RAGFlow\Responses\Files\CreateResponse;
use RAGFlow\Responses\Files\DeleteResponse;
use RAGFlow\Responses\Files\ListResponse;
use RAGFlow\Responses\Files\UpdateResponse;
use RAGFlow\Responses\Files\ParseResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Files implements FilesContract
{
    use Concerns\Transportable;

    /**
     * Upload documents to a specified dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#upload-documents
     */
    public function upload(string $datasetId, array $parameters): CreateResponse
    {
        $payload = Payload::upload("datasets/{$datasetId}/documents", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }

    /**
     * List documents in a specified dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#list-documents
     */
    public function list(string $datasetId, array $parameters = []): ListResponse
    {
        $payload = Payload::list("datasets/{$datasetId}/documents", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    /**
     * Download a document from a specified dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#download-document
     */
    public function download(string $datasetId, string $documentId): string
    {
        $payload = Payload::retrieveContent("datasets/{$datasetId}/documents", $documentId);

        return $this->transporter->requestContent($payload);
    }

    /**
     * Update configurations for a specified document.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#update-document
     */
    public function update(string $datasetId, string $documentId, array $parameters): UpdateResponse
    {
        $payload = Payload::modify("datasets/{$datasetId}/documents", $documentId, $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }

    /**
     * Delete a single document from a dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#delete-documents
     */
    public function delete(string $datasetId, mixed $documentId): DeleteResponse
    {

        $parameters = is_string($documentId) ? ['ids' => [$documentId]] : (isset($documentId['ids']) ? $documentId : ['ids' => $documentId]);
        $payload = Payload::delete("datasets/{$datasetId}/documents", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }



    /**
     * Parse documents in a dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#parse-documents
     */
    public function parse(string $datasetId, array $parameters): ParseResponse
    {
        $payload = Payload::create("datasets/{$datasetId}/chunks", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ParseResponse::from($response->data());
    }

    /**
     * Stop parsing documents.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#stop-parsing-documents
     */
    public function stopParse(string $datasetId, array $parameters): ParseResponse
    {
        $payload = Payload::delete("datasets/{$datasetId}/chunks", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ParseResponse::from($response->data());
    }
}