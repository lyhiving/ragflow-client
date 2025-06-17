<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

final class CompletionResponse extends BaseResponse
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
     * 获取回答内容
     */
    public function answer(): string
    {
        return $this->attributes['answer'];
    }

    /**
     * 获取引用信息
     */
    public function reference(): array
    {
        return $this->attributes['reference'] ?? [];
    }

    /**
     * 获取音频二进制数据
     */
    public function audioBinary(): ?string
    {
        return $this->attributes['audio_binary'] ?? null;
    }

    /**
     * 获取会话ID
     */
    public function sessionId(): string
    {
        return $this->attributes['session_id'];
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return isset($this->attributes['answer']);
    }
}