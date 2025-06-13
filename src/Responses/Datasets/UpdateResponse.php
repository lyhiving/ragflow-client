<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Datasets;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{code: int}>
 */
final class UpdateResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{code: int}>
     */
    use ArrayAccessible;

    /**
     * @param  array{code: int}  $attributes
     */
    private function __construct(
        private readonly array $attributes,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{code: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * Returns the response code.
     */
    public function code(): int
    {
        return $this->attributes['code'];
    }

    /**
     * Returns whether the update was successful.
     */
    public function isSuccessful(): bool
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