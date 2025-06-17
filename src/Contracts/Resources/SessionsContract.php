<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Sessions\CreateResponse;
use RAGFlow\Responses\Sessions\ListResponse;
use RAGFlow\Responses\Sessions\DeleteResponse;
use RAGFlow\Responses\Sessions\UpdateResponse;
use RAGFlow\Responses\StreamResponse;

interface SessionsContract
{
    /**
     * 创建会话
     *
     * @param string $chatId 聊天助手ID
     * @param array<string, mixed> $parameters
     */
    public function create(string $chatId, array $parameters): CreateResponse;

    /**
     * 创建流式会话
     *
     * @param string $chatId 聊天助手ID
     * @param array<string, mixed> $parameters
     * @return StreamResponse
     */
    public function createStreamed(string $chatId, array $parameters): StreamResponse;

    /**
     * 列出会话
     *
     * @param string $chatId 聊天助手ID
     * @param array<string, mixed> $parameters Query parameters (page, page_size, orderby, desc, name, id, user_id)
     */
    public function list(string $chatId, array $parameters = []): ListResponse;

    /**
     * 删除会话
     *
     * @param string $chatId 聊天助手ID
     * @param array<string, mixed> $parameters ids array
     */
    public function delete(string $chatId, array $parameters): DeleteResponse;

    /**
     * 更新会话
     *
     * @param string $chatId 聊天助手ID
     * @param string $sessionId 会话ID
     * @param array<string, mixed> $parameters Update parameters
     */
    public function update(string $chatId, string $sessionId, array $parameters): UpdateResponse;
}