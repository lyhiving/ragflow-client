<?php

namespace lyhiving\ragflow\Api;

class Agent extends BaseApi
{
    /**
     * 创建Agent完成
     *
     * @param string $agentId Agent ID
     * @param string $model 模型名称
     * @param array $messages 消息列表
     * @param bool $stream 是否流式返回
     * @param callable|null $streamCallback 流式回调函数
     * @return array|bool
     */
    public function createAgentCompletion(string $agentId, string $model, array $messages, bool $stream = false, callable $streamCallback = null)
    {
        $uri = "/api/v1/agents_openai/{$agentId}/chat/completions";
        $data = [
            'model' => $model,
            'messages' => $messages,
            'stream' => $stream
        ];

        if ($stream && $streamCallback) {
            return $this->client->stream($uri, $data, $streamCallback);
        }

        return $this->client->post($uri, $data);
    }

    /**
     * 获取Agent列表
     *
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @param string|null $name 名称过滤
     * @param string|null $id ID过滤
     * @return array
     */
    public function listAgents(int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true, ?string $name = null, ?string $id = null)
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

        return $this->client->get('/api/v1/agents', $params);
    }

    /**
     * 创建Agent
     *
     * @param string $title 标题
     * @param string $description 描述
     * @param array $dsl DSL对象
     * @return array
     */
    public function createAgent(string $title, string $description, array $dsl)
    {
        $data = [
            'title' => $title,
            'description' => $description,
            'dsl' => $dsl
        ];

        return $this->client->post('/api/v1/agents', $data);
    }

    /**
     * 更新Agent
     *
     * @param string $agentId Agent ID
     * @param array $data 更新数据
     * @return array
     */
    public function updateAgent(string $agentId, array $data)
    {
        return $this->client->put("/api/v1/agents/{$agentId}", $data);
    }

    /**
     * 删除Agent
     *
     * @param string $agentId Agent ID
     * @return array
     */
    public function deleteAgent(string $agentId)
    {
        return $this->client->delete("/api/v1/agents/{$agentId}");
    }
}