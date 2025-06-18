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
     * Get a specific dataset's information by its ID.
     *
     * @param string $datasetId The ID of the dataset to retrieve.
     * @param array $parameters Optional parameters for the request.
     * @see https://ragflow.io/docs/dev/http_api_reference#get-dataset
     */
    public function get(string $datasetId, array $parameters = []): array
    {
        $parameters['id'] = $datasetId; // 添加数据集ID到请求参数

        /** @var Response<array> $response */
        $response = self::list($parameters);

        // 返回数据中的第一条数据集信息
        return $response->data()[0] ?? [];
    }

    public function getOne(array $conditions): ?array
    {
        $parameters = [];
        foreach ($conditions as $key => $value) {
            $parameters[$key] = $value;
        }

        /** @var Response<array> $response */
        $response = self::list($parameters);

        // 返回数据中的第一条数据集信息
        return $response->data()[0] ?? [];
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
     * @param mixed $datasetId 要删除的数据集ID
     */
    public function delete(mixed $datasetId): DeleteResponse
    {
        $parameters = is_string($datasetId) ? ['ids' => [$datasetId]] : (isset($datasetId['ids']) ? $datasetId : ['ids' => $datasetId]);
        $payload = Payload::delete('datasets', $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }
}
