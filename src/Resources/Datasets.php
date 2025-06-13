<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\DatasetsContract;
use RAGFlow\Responses\Datasets\CreateResponse;
use RAGFlow\Responses\Datasets\DeleteResponse;
use RAGFlow\Responses\Datasets\ListResponse;
use RAGFlow\Responses\Datasets\RetrieveResponse;
use RAGFlow\Responses\Datasets\UpdateResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Datasets implements DatasetsContract
{
    use Concerns\Transportable;

    /**
     * Creates a dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#create-dataset
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('datasets', $parameters);

        /** @var Response<array{id: string, name: string, avatar: string|null, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, pagerank: int, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }

    /**
     * Lists the currently available datasets, and provides basic information about each one.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#list-datasets
     */
    public function list(array $parameters = []): ListResponse
    {
        $payload = Payload::list('datasets', $parameters);

        /** @var Response<array{data: array<int, array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    /**
     * Retrieves a dataset instance, providing basic information about the dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#retrieve-dataset
     */
    public function retrieve(string $datasetId): RetrieveResponse
    {
        $payload = Payload::retrieve('datasets', $datasetId);

        /** @var Response<array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, pagerank: int, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrieveResponse::from($response->data());
    }

    /**
     * Updates configurations for a specified dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#update-dataset
     */
    public function update(string $datasetId, array $parameters): UpdateResponse
    {
        $payload = Payload::update('datasets', $datasetId, $parameters);

        /** @var Response<array{code: int}> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }

    /**
     * Deletes datasets by ID.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#delete-datasets
     */
    public function delete(array $parameters): DeleteResponse
    {
        $payload = Payload::delete('datasets', null, $parameters);

        /** @var Response<array{code: int}> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }
}