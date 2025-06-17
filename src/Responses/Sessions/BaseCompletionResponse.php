<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{answer: string, reference: array, audio_binary: ?string, id: ?string, session_id: string}>
 */
abstract class BaseCompletionResponse implements ResponseContract
{
    use ArrayAccessible;

    /**
     * @param array{answer: string, reference: array, audio_binary: ?string, id: ?string, session_id: string} $attributes
     */
    public function __construct(
        protected array $attributes
    ) {
    }

    /**
     * 从API响应创建实例
     */
    abstract public static function from(array $response): static;

    /**
     * 获取回答内容
     */
    public function answer(): string
    {
        return $this->attributes['answer'] ?? '';
    }

    /**
     * 获取引用信息
     */
    public function reference(): array
    {
        return $this->attributes['reference'] ?? [];
    }

    /**
     * 获取会话ID
     */
    public function sessionId(): string
    {
        return $this->attributes['session_id'] ?? '';
    }

    /**
     * 获取消息ID
     */
    public function id(): ?string
    {
        return $this->attributes['id'] ?? null;
    }

    /**
     * 获取音频数据
     */
    public function audioBinary(): ?string
    {
        return $this->attributes['audio_binary'] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}