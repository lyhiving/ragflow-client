<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;

/**
 * @implements ResponseContract<array{code: int}>
 */
final class DeleteResponse implements ResponseContract
{
    /**
     * @param  array{code: int}  $attributes
     */
    public function __construct(
        public readonly array $attributes,
    ) {
    }

    /**
     * 从响应数据创建实例
     *
     * @param  array{code: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * 检查删除是否成功
     */
    public function isDeleted(): bool
    {
        return $this->attributes['code'] === 0;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}