<?php

namespace lyhiving\ragflow\Api;

class Document extends BaseApi
{
    /**
     * 上传文档
     *
     * @param string $datasetId 数据集ID
     * @param string $filePath 文件路径
     * @param array $options 其他选项
     * @return array
     */
    public function uploadDocument(string $datasetId, string $filePath, array $options = [])
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File does not exist: {$filePath}");
        }

        $multipart = [
            [
                'name' => 'file',
                'contents' => fopen($filePath, 'r'),
                'filename' => basename($filePath)
            ]
        ];

        // 添加其他字段
        foreach ($options as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => is_array($value) ? json_encode($value) : (string)$value
            ];
        }

        return $this->client->postMultipart("/api/v1/datasets/{$datasetId}/documents", $multipart);
    }

    /**
     * 批量上传文档
     *
     * @param string $datasetId 数据集ID
     * @param array $filePaths 文件路径数组
     * @param array $options 其他选项
     * @return array
     */
    public function uploadDocuments(string $datasetId, array $filePaths, array $options = [])
    {
        $multipart = [];

        foreach ($filePaths as $filePath) {
            if (!file_exists($filePath)) {
                throw new \InvalidArgumentException("File does not exist: {$filePath}");
            }

            $multipart[] = [
                'name' => 'files[]',
                'contents' => fopen($filePath, 'r'),
                'filename' => basename($filePath)
            ];
        }

        // 添加其他字段
        foreach ($options as $key => $value) {
            $multipart[] = [
                'name' => $key,
                'contents' => is_array($value) ? json_encode($value) : (string)$value
            ];
        }

        return $this->client->postMultipart("/api/v1/datasets/{$datasetId}/documents", $multipart);
    }

    /**
     * 更新文档
     *
     * @param string $documentId 文档ID
     * @param array $data 更新数据
     * @return array
     */
    public function updateDocument(string $documentId, array $data)
    {
        return $this->client->put("/api/v1/documents/{$documentId}", $data);
    }

    /**
     * 下载文档
     *
     * @param string $documentId 文档ID
     * @param string $savePath 保存路径
     * @return bool
     */
    public function downloadDocument(string $documentId, string $savePath)
    {
        return $this->client->downloadFile("/api/v1/documents/{$documentId}/download", $savePath);
    }

    /**
     * 获取文档列表
     *
     * @param string $datasetId 数据集ID
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @param string|null $name 名称过滤
     * @param string|null $status 状态过滤
     * @return array
     */
    public function listDocuments(string $datasetId, int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true, ?string $name = null, ?string $status = null)
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize,
            'orderby' => $orderby,
            'desc' => $desc
        ];

        if ($name) {
            $params['name'] = $name;
        }

        if ($status) {
            $params['status'] = $status;
        }

        return $this->client->get("/api/v1/datasets/{$datasetId}/documents", $params);
    }

    /**
     * 删除文档
     *
     * @param string $documentId 文档ID
     * @return array
     */
    public function deleteDocument(string $documentId)
    {
        return $this->client->delete("/api/v1/documents/{$documentId}");
    }

    /**
     * 批量删除文档
     *
     * @param array $documentIds 文档ID数组
     * @return array
     */
    public function deleteDocuments(array $documentIds)
    {
        $data = ['documents' => $documentIds];
        return $this->client->delete('/api/v1/documents', $data);
    }

    /**
     * 解析文档
     *
     * @param array $documentIds 文档ID数组
     * @return array
     */
    public function parseDocuments(array $documentIds)
    {
        $data = ['documents' => $documentIds];
        return $this->client->post('/api/v1/documents/parse', $data);
    }

    /**
     * 停止解析文档
     *
     * @param array $documentIds 文档ID数组
     * @return array
     */
    public function stopParsingDocuments(array $documentIds)
    {
        $data = ['documents' => $documentIds];
        return $this->client->post('/api/v1/documents/stop_parse', $data);
    }
}