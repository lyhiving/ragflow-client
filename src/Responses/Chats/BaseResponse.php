<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Chats;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{code: int, message?: string, data?: mixed}>
 */
abstract class BaseResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{code: int, message?: string, data?: mixed}>
     */
    use ArrayAccessible;

    /**
     * @param array{code: int, message?: string, data?: mixed} $attributes
     */
    final public function __construct(
        protected readonly array $attributes,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{code: int, message?: string, data?: mixed} $attributes
     */
    public static function from(array $attributes): static
    {
        return new static($attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * 获取响应代码
     */
    public function getCode(): int
    {
        return $this->attributes['code'];
    }

    /**
     * 获取响应消息
     */
    public function getMessage(): ?string
    {
        return $this->attributes['message'] ?? null;
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return $this->getCode() === 0;
    }

    /**
     * 获取响应数据
     */
    public function getData(): mixed
    {
        return $this->attributes['data'] ?? null;
    }
}