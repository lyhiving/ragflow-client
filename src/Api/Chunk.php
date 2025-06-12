<?php

namespace lyhiving\ragflow\Api;

class Chunk extends BaseApi
{
    /**
     * 添加文档块
     *
     * @param string $datasetId 数据集ID
     * @param string $content 内容
     * @param array $options 其他选项
     * @return array
     */
    public function addChunk(string $datasetId, string $content, array $options = [])
    {
        $data = array_merge([
            'content' => $content
        ], $options);

        return $this->client->post("/api/v1/datasets/{$datasetId}/chunks", $data);
    }

    /**
     * 获取文档块列表
     *
     * @param string $datasetId 数据集ID
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @param string|null $documentId 文档ID过滤
     * @param string|null $keywords 关键词过滤
     * @return array
     */
    public function listChunks(string $datasetId, int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true, ?string $documentId = null, ?string $keywords = null)
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize,
            'orderby' => $orderby,
            'desc' => $desc
        ];

        if ($documentId) {
            $params['document_id'] = $documentId;
        }

        if ($keywords) {
            $params['keywords'] = $keywords;
        }

        return $this->client->get("/api/v1/datasets/{$datasetId}/chunks", $params);
    }

    /**
     * 删除文档块
     *
     * @param string $chunkId 文档块ID
     * @return array
     */
    public function deleteChunk(string $chunkId)
    {
        return $this->client->delete("/api/v1/chunks/{$chunkId}");
    }

    /**
     * 批量删除文档块
     *
     * @param array $chunkIds 文档块ID数组
     * @return array
     */
    public function deleteChunks(array $chunkIds)
    {
        $data = ['chunks' => $chunkIds];
        return $this->client->delete('/api/v1/chunks', $data);
    }

    /**
     * 更新文档块
     *
     * @param string $chunkId 文档块ID
     * @param array $data 更新数据
     * @return array
     */
    public function updateChunk(string $chunkId, array $data)
    {
        return $this->client->put("/api/v1/chunks/{$chunkId}", $data);
    }

    /**
     * 检索文档块
     *
     * @param string $datasetId 数据集ID
     * @param string $query 查询内容
     * @param int $topK 返回数量
     * @param float $similarity 相似度阈值
     * @param array $options 其他选项
     * @return array
     */
    public function retrieveChunks(string $datasetId, string $query, int $topK = 5, float $similarity = 0.7, array $options = [])
    {
        $data = array_merge([
            'query' => $query,
            'top_k' => $topK,
            'similarity' => $similarity
        ], $options);

        return $this->client->post("/api/v1/datasets/{$datasetId}/chunks/retrieve", $data);
    }
}