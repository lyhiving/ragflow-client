<?php

namespace lyhiving\ragflow\Api;

class Chat extends BaseApi
{
    /**
     * 创建聊天完成
     *
     * @param string $chatId 聊天ID
     * @param string $model 模型名称
     * @param array $messages 消息列表
     * @param bool $stream 是否流式返回
     * @param callable|null $streamCallback 流式回调函数
     * @return array|bool
     */
    public function createChatCompletion(string $chatId, string $model, array $messages, bool $stream = false, callable $streamCallback = null)
    {
        $uri = "/api/v1/chats_openai/{$chatId}/chat/completions";
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
     * 创建聊天助手
     *
     * @param string $title 标题
     * @param string $description 描述
     * @param array $datasets 数据集列表
     * @param array $options 其他选项
     * @return array
     */
    public function createChatAssistant(string $title, string $description, array $datasets, array $options = [])
    {
        $data = array_merge([
            'title' => $title,
            'description' => $description,
            'datasets' => $datasets
        ], $options);

        return $this->client->post('/api/v1/chat_assistants', $data);
    }

    /**
     * 更新聊天助手
     *
     * @param string $assistantId 助手ID
     * @param array $data 更新数据
     * @return array
     */
    public function updateChatAssistant(string $assistantId, array $data)
    {
        return $this->client->put("/api/v1/chat_assistants/{$assistantId}", $data);
    }

    /**
     * 删除聊天助手
     *
     * @param string $assistantId 助手ID
     * @return array
     */
    public function deleteChatAssistant(string $assistantId)
    {
        return $this->client->delete("/api/v1/chat_assistants/{$assistantId}");
    }

    /**
     * 获取聊天助手列表
     *
     * @param int $page 页码
     * @param int $pageSize 每页数量
     * @param string $orderby 排序字段
     * @param bool $desc 是否降序
     * @param string|null $name 名称过滤
     * @param string|null $id ID过滤
     * @return array
     */
    public function listChatAssistants(int $page = 1, int $pageSize = 30, string $orderby = 'create_time', bool $desc = true, ?string $name = null, ?string $id = null)
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

        return $this->client->get('/api/v1/chat_assistants', $params);
    }
}