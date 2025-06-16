<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\ChunksContract;
use RAGFlow\Responses\Chunks\CreateResponse;
use RAGFlow\Responses\Chunks\DeleteResponse;
use RAGFlow\Responses\Chunks\ListResponse;
use RAGFlow\Responses\Chunks\UpdateResponse;
use RAGFlow\Responses\Chunks\RetrievalResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Chunks implements ChunksContract
{
    use Concerns\Transportable;

    /**
     * 在指定文档中添加 Chunk
     */
    public function create(string $datasetId, string $documentId, array $parameters): CreateResponse
    {
        $payload = Payload::create("datasets/{$datasetId}/documents/{$documentId}/chunks", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }


    /**
     * 获取指定 Chunk 的信息
     */
    public function get(string $datasetId, string $documentId, string $chunkId, array $parameters = []): array
    {
        $parameters['id'] = $chunkId; // 添加文档ID到请求参数
        $response = self::list($datasetId, $documentId, $parameters);
        if(!isset($response['data']['chunks'][0])){
            return [];
        }
        $result = $response['data']['chunks'][0];
        $result['doc'] = $response['data']['doc']??[];
        return $result;
    }

    /**
     * 列出指定文档中的 Chunks
     */
    public function list(string $datasetId, string $documentId, array $parameters = []): ListResponse
    {
        $payload = Payload::list("datasets/{$datasetId}/documents/{$documentId}/chunks", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    /**
     * 删除指定文档中的 Chunks
     */
    public function delete(string $datasetId, string $documentId, array $parameters): DeleteResponse
    {
        $payload = Payload::delete("datasets/{$datasetId}/documents/{$documentId}/chunks", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }

    /**
     * 更新指定 Chunk 的内容或配置
     */
    public function update(string $datasetId, string $documentId, string $chunkId, array $parameters): UpdateResponse
    {
        $payload = Payload::modify("datasets/{$datasetId}/documents/{$documentId}/chunks", $chunkId, $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }

    /**
     * 从指定数据集中检索 chunks。
     *
     * @param array<string, mixed> $parameters 检索参数
     */
    public function retrieve(array $parameters): RetrievalResponse
    {
        $payload = Payload::create('retrieval', $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return RetrievalResponse::from($response->data());
    }
}
