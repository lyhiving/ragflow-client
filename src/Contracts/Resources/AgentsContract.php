<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Agents\CreateResponse;
use RAGFlow\Responses\Agents\ListResponse;
use RAGFlow\Responses\Agents\DeleteResponse;
use RAGFlow\Responses\Agents\UpdateResponse;

interface AgentsContract
{
    /**
     * 创建代理
     *
     * @param array<string, mixed> $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * 列出代理
     *
     * @param array<string, mixed> $parameters Query parameters (page, page_size, orderby, desc, name, id)
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * 删除代理
     *
     * @param string $agentId Agent ID
     */
    public function delete(string $agentId): DeleteResponse;

    /**
     * 更新代理配置
     *
     * @param string $agentId Agent ID
     * @param array<string, mixed> $parameters Update parameters
     */
    public function update(string $agentId, array $parameters): UpdateResponse;

    /**
     * 获取单个代理信息
     *
     * @param string $agentId Agent ID
     * @param array<string, mixed> $parameters Query parameters
     * @return array|null
     */
    public function get(string $agentId, array $parameters = []): ?array;
}