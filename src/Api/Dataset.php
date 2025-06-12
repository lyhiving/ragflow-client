<?php

namespace lyhiving\ragflow\Api;

class Dataset extends BaseApi
{
    /**
     * 创建数据集
     *
     * @param string $name 数据集名称
     * @param string $description 数据集描述
     * @param array $options 其他选项
     * @return array
     */
    public function createDataset(string $name, string $description, array $options = [])
    {
        $data = array_merge([
            'name' => $name,
            'description' => $description
        ], $options);

        return $this->client->post('/api/v1/datasets', $data);
    }

    /**
     * 删除数据集
     *
     * @param string $datasetId 数据集ID
     * @return array
     */
    public function deleteDataset(string $datasetId)
    {
        return $this->client->delete("/api/v1/datasets/{$datasetId}");
    }

    /**
     * 批量删除数据集
     *
     * @param array $datasetIds 数据集ID数组
     * @return array
     */
    public function deleteDatasets(array $datasetIds)
    {
        $data = ['datasets' => $datasetIds];
        return $this->client->delete('/api/v1/datasets', $data);
    }

    /**
     * 更新数据集
     *
     * @param string $datasetId 数据集ID
     * @param array $data 更新数据
     * @return array
     */
    public function updateDataset(string $datasetId, array $data)
    {
        return $this->client->put("/api/v1/datasets/{$datasetId}", $data);
    }

    /**
     * 获取数据集列表
     *
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @param string|null $name 名称过滤
     * @param string|null $id ID过滤
     * @return array
     */
    public function listDatasets(int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true, ?string $name = null, ?string $id = null)
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

        if ($id) {
            $params['id'] = $id;
        }

        return $this->client->get('/api/v1/datasets', $params);
    }
}