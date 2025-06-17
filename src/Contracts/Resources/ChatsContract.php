<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Chats\CreateResponse;
use RAGFlow\Responses\Chats\ListResponse;
use RAGFlow\Responses\Chats\DeleteResponse;
use RAGFlow\Responses\Chats\UpdateResponse;
use RAGFlow\Responses\StreamResponse;

interface ChatsContract
{
    /**
     * 创建聊天助手
     *
     * @param array<string, mixed> $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * 创建流式聊天助手
     *
     * @param array<string, mixed> $parameters
     * @return StreamResponse
     */
    public function createStreamed(array $parameters): StreamResponse;

    /**
     * 列出聊天助手
     *
     * @param array<string, mixed> $parameters Query parameters (page, page_size, orderby, desc, name, id)
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * 删除聊天助手
     *
     * @param array<string, mixed> $parameters ids array
     */
    public function delete(array $parameters): DeleteResponse;

    /**
     * 更新聊天助手配置
     *
     * @param string $chatId Chat ID
     * @param array<string, mixed> $parameters Update parameters
     */
    public function update(string $chatId, array $parameters): UpdateResponse;
}