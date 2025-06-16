<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Chunks\CreateResponse;
use RAGFlow\Responses\Chunks\ListResponse;
use RAGFlow\Responses\Chunks\DeleteResponse;
use RAGFlow\Responses\Chunks\UpdateResponse;

interface ChunksContract
{
    /**
     * 在指定文档中添加 Chunk
     *
     * @param string $datasetId 数据集 ID
     * @param string $documentId 文档 ID
     * @param array<string, mixed> $parameters
     */
    public function create(string $datasetId, string $documentId, array $parameters): CreateResponse;

    /**
     * 列出指定文档中的 Chunks
     *
     * @param string $datasetId 数据集 ID
     * @param string $documentId 文档 ID
     * @param array<string, mixed> $parameters Query parameters (keywords, page, page_size, id)
     */
    public function list(string $datasetId, string $documentId, array $parameters = []): ListResponse;

    /**
     * 删除指定文档中的 Chunks
     *
     * @param string $datasetId 数据集 ID
     * @param string $documentId 文档 ID
     * @param array<string, array<string>> $parameters chunk_ids
     */
    public function delete(string $datasetId, string $documentId, array $parameters): DeleteResponse;

    /**
     * 更新指定 Chunk 的内容或配置
     *
     * @param string $datasetId 数据集 ID
     * @param string $documentId 文档 ID
     * @param string $chunkId Chunk ID
     * @param array<string, mixed> $parameters Update parameters
     */
    public function update(string $datasetId, string $documentId, string $chunkId, array $parameters): UpdateResponse;
}