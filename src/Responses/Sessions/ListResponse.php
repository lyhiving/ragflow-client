<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

final class ListResponse extends BaseResponse
{
    /**
     * 从API响应创建实例
     *
     * @param array{code: int, message?: string, data: array} $response
     */
    public static function from(array $response): static
    {
        if ($response['code'] !== 0) {
            throw new \RuntimeException($response['message'] ?? '未知错误', $response['code']);
        }
        
        return new static($response['data']);
    }

    /**
     * 获取会话列表数据
     */
    public function data(): array
    {
        return $this->attributes['data'] ?? [];
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return isset($this->attributes['data']);
    }
}