<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @param  array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}  $attributes
     */
    public function __construct(
        public readonly array $attributes,
    ) {
    }

    /**
     * 从响应数据创建实例
     *
     * @param  array{code: int, data: array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes['data']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}