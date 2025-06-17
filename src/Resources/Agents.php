<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\AgentsContract;
use RAGFlow\Responses\Agents\CreateResponse;
use RAGFlow\Responses\Agents\DeleteResponse;
use RAGFlow\Responses\Agents\ListResponse;
use RAGFlow\Responses\Agents\UpdateResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Agents implements AgentsContract
{
    use Concerns\Transportable;

    /**
     * 创建代理
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create("agents", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }

    /**
     * 获取指定代理的信息
     */
    public function get(string $agentId, array $parameters = []): ?array
    {
        $parameters['id'] = $agentId;
        $response = $this->list($parameters);
        $agents = $response->getAgents();
        if (!isset($agents[0])) {
            return null;
        }
        return $agents[0];
    }

    /**
     * 列出代理
     */
    public function list(array $parameters = []): ListResponse
    {
        $payload = Payload::list("agents", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    /**
     * 删除代理
     */
    public function delete(string $agentId): DeleteResponse
    {
        // 直接使用完整路径，不传递额外参数
        $payload = Payload::delete("agents/{$agentId}", []);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }

    /**
     * 更新代理配置
     */
    public function update(string $agentId, array $parameters): UpdateResponse
    {
        $payload = Payload::modify("agents", $agentId, $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }
}