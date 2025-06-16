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
     * Supported parameters:
     * - name: (string) The name of the document
     * - meta_fields: (array) The meta fields of the document as key-value pairs
     * - chunk_method: (string) The parsing method (naive, manual, qa, table, paper, book, laws, presentation, picture, one, email)
     * - parser_config: (array) The configuration settings for the dataset parser
     *
     * @param string $datasetId The ID of the associated dataset
     * @param string $documentId The ID of the document to update
     * @param array $parameters The update parameters
     * @return UpdateResponse
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#update-document
     */
    public function update(string $datasetId, string $documentId, array $parameters): UpdateResponse
    {
        // 验证 chunk_method 参数（如果提供）
        if (isset($parameters['chunk_method'])) {
            $validChunkMethods = [
                'naive', 'manual', 'qa', 'table', 'paper', 
                'book', 'laws', 'presentation', 'picture', 'one', 'email'
            ];
            
            if (!in_array($parameters['chunk_method'], $validChunkMethods)) {
                throw new \InvalidArgumentException(
                    'Invalid chunk_method. Valid values are: ' . implode(', ', $validChunkMethods)
                );
            }
        }

        // 验证 meta_fields 参数（如果提供）
        if (isset($parameters['meta_fields'])) {
            $this->validateMetaFields($parameters['meta_fields']);
        }

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

    /**
     * 验证元数据字段格式
     *
     * @param mixed $metaFields 元数据字段
     * @throws \InvalidArgumentException 当格式无效时
     */
    private function validateMetaFields(mixed $metaFields): void
    {
        if (!is_array($metaFields)) {
            throw new \InvalidArgumentException('meta_fields must be an array');
        }

        if (empty($metaFields)) {
            return; // 空数组是有效的
        }

        // 检查是否为关联数组
        if (array_keys($metaFields) === range(0, count($metaFields) - 1)) {
            throw new \InvalidArgumentException('meta_fields must be an associative array');
        }

        // 检查键是否都是字符串
        foreach (array_keys($metaFields) as $key) {
            if (!is_string($key)) {
                throw new \InvalidArgumentException('All meta_fields keys must be strings');
            }
        }
    }

    /**
     * 创建标准化的元数据字段
     *
     * @param array $fields 原始字段数据
     * @return array 标准化的元数据字段
     */
    public function createMetaFields(array $fields): array
    {
        $metaFields = [];
        
        foreach ($fields as $key => $value) {
            // 确保键是字符串
            $fieldKey = is_string($key) ? $key : (string)$key;
            $metaFields[$fieldKey] = $value;
        }
        
        return $metaFields;
    }

    /**
     * 批量更新文档
     *
     * @param string $datasetId 数据集ID
     * @param array $updates 更新数据数组，每个元素包含document_id和更新数据
     * @return array 更新结果数组
     */
    public function batchUpdate(string $datasetId, array $updates): array
    {
        $results = [];
        
        foreach ($updates as $update) {
            if (!isset($update['document_id'])) {
                throw new \InvalidArgumentException('Each update must contain document_id');
            }
            
            $documentId = $update['document_id'];
            unset($update['document_id']);
            
            try {
                $results[$documentId] = $this->update($datasetId, $documentId, $update);
            } catch (\Exception $e) {
                $results[$documentId] = [
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return $results;
    }
}