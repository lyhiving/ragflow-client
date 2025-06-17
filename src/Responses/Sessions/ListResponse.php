<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{data: array<int, array{id: string, chat: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>}>
 */
final class ListResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{data: array<int, array{id: string, chat: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array{data: array<int, array{id: string, chat: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>}  $attributes
     */
    public function __construct(
        public readonly array $attributes,
    ) {
    }

    /**
     * 从响应数据创建实例
     *
     * @param  array{code: int, data: array<int, array{id: string, chat: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * 获取会话列表
     */
    public function data(): array
    {
        return $this->attributes['data'];
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}