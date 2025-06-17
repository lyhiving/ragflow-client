<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

final class DeleteResponse extends BaseResponse
{
    /**
     * 从API响应创建实例
     *
     * @param array{code: int, message?: string} $response
     */
    public static function from(array $response): static
    {
        if ($response['code'] !== 0) {
            throw new \RuntimeException($response['message'] ?? '未知错误', $response['code']);
        }
        
        return new static($response['data']);
    }

    /**
     * 检查删除是否成功
     */
    public function isDeleted(): bool
    {
        return isset($this->attributes['code']) && $this->attributes['code'] === 0;
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return $this->isDeleted();
    }
}