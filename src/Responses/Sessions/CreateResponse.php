<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

final class CreateResponse extends BaseResponse
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
     * 检查会话是否创建成功
     */
    public function isCreated(): bool
    {
        return isset($this->attributes['id']) && !empty($this->attributes['id']);
    }

    /**
     * 获取初始消息
     */
    public function getInitialMessage(): ?array
    {
        $messages = $this->messages();
        return !empty($messages) ? $messages[0] : null;
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return $this->isCreated();
    }
}