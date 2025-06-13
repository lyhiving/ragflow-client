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
     * Deletes a single dataset by ID.
     *
     * @param string $datasetId 要删除的数据集ID
     */
    public function delete(string $datasetId): DeleteResponse
    {
        $payload = Payload::delete('datasets', $datasetId);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }

    /**
     * Deletes multiple datasets by IDs.
     *
     * @param array{ids?: array<string>|null}|string[] $parameters 数据集ID列表或包含ids键的数组
     * @see https://ragflow.io/docs/dev/http_api_reference#delete-datasets
     */
    public function deletes(array $parameters): DeleteResponse
    {
        // 处理参数格式
        if (!isset($parameters['ids'])) {
            $parameters = ['ids' => $parameters];
        }

        // null 表示删除所有数据集
        // 空数组表示不删除任何数据集
        // 否则删除指定的数据集
        $payload = Payload::deletes('datasets', $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }
}