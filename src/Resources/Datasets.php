<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\DatasetsContract;
use RAGFlow\Responses\Datasets\CreateResponse;
use RAGFlow\Responses\Datasets\DeleteResponse;
use RAGFlow\Responses\Datasets\ListResponse;
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

        /** @var Response<array> $response */
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

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    /**
     * Updates configurations for a specified dataset.
     *
     * @param string $datasetId
     * @param array{name?: string, avatar?: string, description?: string, embedding_model?: string, permission?: string, chunk_method?: string, pagerank?: int, parser_config?: array} $parameters
     * @see https://ragflow.io/docs/dev/http_api_reference#update-dataset
     */
    public function update(string $datasetId, array $parameters): UpdateResponse
    {
        $payload = Payload::modify('datasets', $datasetId, $parameters);

        /** @var Response<array> $response */
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

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }
}