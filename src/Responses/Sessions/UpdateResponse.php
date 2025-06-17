<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

final class UpdateResponse extends BaseResponse
{
    /**
     * 从API响应创建实例
     *
     * @param array{code: int, message?: string} $response
     */
    public static function from(array $response): static
    {
        return new static($response);
    }

    /**
     * 检查更新是否成功
     */
    public function isUpdated(): bool
    {
        return $this->attributes['code'] === 0;
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return $this->isUpdated();
    }
    
    /**
     * 获取响应代码
     */
    public function code(): int
    {
        return $this->attributes['code'];
    }
    
    /**
     * 获取响应消息
     */
    public function message(): string
    {
        return $this->attributes['message'] ?? '';
    }
}