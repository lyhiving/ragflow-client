<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

final class CreateResponse extends BaseResponse
{
    /**
     * 从API响应创建实例
     *
     * @param array{
     *     code: int,
     *     message?: string,
     *     data?: array{
     *         agent_id?: string,
     *         dsl?: array{
     *             answer: array,
     *             components: array<string, array{
     *                 downstream: array,
     *                 obj: array{
     *                     component_name: string,
     *                     inputs: array,
     *                     output: mixed,
     *                     params: array
     *                 },
     *                 upstream: array
     *             }>,
     *             graph: array{
     *                 edges: array,
     *                 nodes: array
     *             },
     *             history: array,
     *             messages: array,
     *             path: array,
     *             reference: array
     *         },
     *         id: string,
     *         message?: array{
     *             content: string,
     *             role: string
     *         }[],
     *         source?: string,
     *         user_id?: string
     *     }
     * } $response
     */
    public static function from(array $response): static
    {
        if ($response['code'] !== 0) {
            throw new \RuntimeException($response['message'] ?? '未知错误', $response['code']);
        }

        return new static($response['data']);
    }

    /**
     * 获取会话ID
     */
    public function id(): string
    {
        return $this->attributes['id'];
    }

    /**
     * 获取代理ID
     */
    public function agentId(): ?string
    {
        return $this->attributes['agent_id'] ?? null;
    }

    /**
     * 获取DSL配置
     */
    public function dsl(): ?array
    {
        return $this->attributes['dsl'] ?? null;
    }

    /**
     * 获取源类型
     */
    public function source(): ?string
    {
        return $this->attributes['source'] ?? null;
    }

    /**
     * 获取用户ID
     */
    public function userId(): ?string
    {
        return $this->attributes['user_id'] ?? null;
    }

    /**
     * 获取初始消息
     */
    public function getInitialMessage(): ?array
    {
        return $this->attributes['message'][0] ?? null;
    }

    /**
     * 检查是否创建成功
     */
    public function isCreated(): bool
    {
        return isset($this->attributes['id']);
    }
}