<?php

namespace lyhiving\ragflow\Api;

class Session extends BaseApi
{
    /**
     * 创建聊天助手会话
     *
     * @param string $assistantId 助手ID
     * @param string $name 会话名称
     * @return array
     */
    public function createChatSession(string $assistantId, string $name)
    {
        $data = [
            'name' => $name
        ];

        return $this->client->post("/api/v1/chat_assistants/{$assistantId}/sessions", $data);
    }

    /**
     * 更新聊天助手会话
     *
     * @param string $sessionId 会话ID
     * @param array $data 更新数据
     * @return array
     */
    public function updateChatSession(string $sessionId, array $data)
    {
        return $this->client->put("/api/v1/sessions/{$sessionId}", $data);
    }

    /**
     * 获取聊天助手会话列表
     *
     * @param string $assistantId 助手ID
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @return array
     */
    public function listChatSessions(string $assistantId, int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true)
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize,
            'orderby' => $orderby,
            'desc' => $desc
        ];

        return $this->client->get("/api/v1/chat_assistants/{$assistantId}/sessions", $params);
    }

    /**
     * 删除聊天助手会话
     *
     * @param string $sessionId 会话ID
     * @return array
     */
    public function deleteChatSession(string $sessionId)
    {
        return $this->client->delete("/api/v1/sessions/{$sessionId}");
    }

    /**
     * 批量删除聊天助手会话
     *
     * @param array $sessionIds 会话ID数组
     * @return array
     */
    public function deleteChatSessions(array $sessionIds)
    {
        $data = ['sessions' => $sessionIds];
        return $this->client->delete('/api/v1/sessions', $data);
    }

    /**
     * 与聊天助手对话
     *
     * @param string $sessionId 会话ID
     * @param string $message 消息内容
     * @param bool $stream 是否流式返回
     * @param callable|null $streamCallback 流式回调函数
     * @return array|bool
     */
    public function converseWithChatAssistant(string $sessionId, string $message, bool $stream = false, callable $streamCallback = null)
    {
        $data = [
            'message' => $message,
            'stream' => $stream
        ];

        if ($stream && $streamCallback) {
            return $this->client->stream("/api/v1/sessions/{$sessionId}/completions", $data, $streamCallback);
        }

        return $this->client->post("/api/v1/sessions/{$sessionId}/completions", $data);
    }

    /**
     * 创建Agent会话
     *
     * @param string $agentId Agent ID
     * @param string $name 会话名称
     * @return array
     */
    public function createAgentSession(string $agentId, string $name)
    {
        $data = [
            'name' => $name
        ];

        return $this->client->post("/api/v1/agents/{$agentId}/sessions", $data);
    }

    /**
     * 与Agent对话
     *
     * @param string $agentId Agent ID
     * @param string $sessionId 会话ID
     * @param string $message 消息内容
     * @param bool $stream 是否流式返回
     * @param callable|null $streamCallback 流式回调函数
     * @return array|bool
     */
    public function converseWithAgent(string $agentId, string $sessionId, string $message, bool $stream = false, callable $streamCallback = null)
    {
        $data = [
            'message' => $message,
            'stream' => $stream
        ];

        if ($stream && $streamCallback) {
            return $this->client->stream("/api/v1/agents/{$agentId}/sessions/{$sessionId}/completions", $data, $streamCallback);
        }

        return $this->client->post("/api/v1/agents/{$agentId}/sessions/{$sessionId}/completions", $data);
    }

    /**
     * 获取Agent会话列表
     *
     * @param string $agentId Agent ID
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @return array
     */
    public function listAgentSessions(string $agentId, int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true)
    {
        $params = [
            'page' => $page,
            'page_size' => $pageSize,
            'orderby' => $orderby,
            'desc' => $desc
        ];

        return $this->client->get("/api/v1/agents/{$agentId}/sessions", $params);
    }

    /**
     * 删除Agent会话
     *
     * @param string $agentId Agent ID
     * @param array $sessionIds 会话ID数组
     * @return array
     */
    public function deleteAgentSessions(string $agentId, array $sessionIds)
    {
        $data = ['sessions' => $sessionIds];
        return $this->client->delete("/api/v1/agents/{$agentId}/sessions", $data);
    }

    /**
     * 获取相关问题
     *
     * @param string $sessionId 会话ID
     * @return array
     */
    public function getRelatedQuestions(string $sessionId)
    {
        return $this->client->get("/api/v1/sessions/{$sessionId}/related_questions");
    }
}