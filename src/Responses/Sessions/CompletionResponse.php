<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{answer: string, reference: array, audio_binary: ?string, id: ?string, session_id: string}>
 */
final class CompletionResponse implements ResponseContract
{
    /**
     * @param array{answer: string, reference: array, audio_binary: ?string, id: ?string, session_id: string} $attributes
     */
    public function __construct(
        public readonly array $attributes,
    ) {
    }

    /**
     * 从响应数据创建实例
     *
     * @param array{code: int, data: array{answer: string, reference: array, audio_binary: ?string, id: ?string, session_id: string}} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes['data']);
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
        return $this->attributes['reference'];
    }

    /**
     * 获取音频二进制数据
     */
    public function audioBinary(): ?string
    {
        return $this->attributes['audio_binary'];
    }

    /**
     * 获取消息ID
     */ 
    public function id(): ?string
    {
        return $this->attributes['id'];
    }

    /**
     * 获取会话ID
     */
    public function sessionId(): string
    {
        return $this->attributes['session_id'];
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}