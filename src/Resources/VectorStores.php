<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\VectorStoresContract;
use RAGFlow\Contracts\Resources\VectorStoresFileBatchesContract;
use RAGFlow\Contracts\Resources\VectorStoresFilesContract;
use RAGFlow\Responses\VectorStores\VectorStoreDeleteResponse;
use RAGFlow\Responses\VectorStores\VectorStoreListResponse;
use RAGFlow\Responses\VectorStores\VectorStoreResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class VectorStores implements VectorStoresContract
{
    use Concerns\Transportable;

    /**
     * Create a vector store
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#vector-stores/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): VectorStoreResponse
    {
        $payload = Payload::create('vector_stores', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of vector stores.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#vector-stores/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): VectorStoreListResponse
    {
        $payload = Payload::list('vector_stores', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreListResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves a vector store.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#vector-stores/retrieve
     */
    public function retrieve(string $vectorStoreId): VectorStoreResponse
    {
        $payload = Payload::retrieve('vector_stores', $vectorStoreId);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreResponse::from($response->data(), $response->meta());
    }

    /**
     * Modify a vector store
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#vector-stores/modify
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $vectorStoreId, array $parameters): VectorStoreResponse
    {
        $payload = Payload::modify('vector_stores', $vectorStoreId, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, usage_bytes: int, file_counts: array{in_progress: int, completed: int, failed: int, cancelled: int, total: int}, status: string, expires_after: ?array{anchor: string, days: int}, expires_at: ?int, last_active_at: ?int, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete a vector store.
     *
     * https://ragflow.io/docs/dev/http_api_reference#vector-stores/delete
     */
    public function delete(string $vectorStoreId): VectorStoreDeleteResponse
    {
        $payload = Payload::delete('vector_stores', $vectorStoreId);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return VectorStoreDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Manage the files related to the vector store
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#vector-stores-files
     */
    public function files(): VectorStoresFilesContract
    {
        return new VectorStoresFiles($this->transporter);
    }

    /**
     * Manage the file batches related to the vector store
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#vector-stores-file-batches
     */
    public function batches(): VectorStoresFileBatchesContract
    {
        return new VectorStoresFileBatches($this->transporter);
    }
}
