<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Assistants\CreateResponse;
use RAGFlow\Responses\Assistants\ListResponse;
use RAGFlow\Responses\Assistants\DeleteResponse;
use RAGFlow\Responses\Assistants\UpdateResponse;
use RAGFlow\Responses\StreamResponse;

interface AssistantsContract
{
    /**
     * 创建助手
     *
     * @param array<string, mixed> $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * 创建流式助手
     *
     * @param array<string, mixed> $parameters
     * @return StreamResponse
     */
    public function createStreamed(array $parameters): StreamResponse;

    /**
     * 列出助手
     *
     * @param array<string, mixed> $parameters Query parameters (page, page_size, orderby, desc, name, id)
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * 删除助手
     *
     * @param array<string, mixed> $parameters ids array
     */
    public function delete(array $parameters): DeleteResponse;

    /**
     * 更新助手配置
     *
     * @param string $assistantId Assistant ID
     * @param array<string, mixed> $parameters Update parameters
     */
    public function update(string $assistantId, array $parameters): UpdateResponse;
}