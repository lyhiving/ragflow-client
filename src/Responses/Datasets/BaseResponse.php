<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Datasets;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

abstract class BaseResponse implements ResponseContract
{
    use ArrayAccessible;

    /**
     * @param array $attributes
     */
    private function __construct(
        protected readonly array $attributes,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array $attributes
     */
    public static function from(array $attributes): static
    {
        return new static($attributes);
    }

    /**
     * Returns whether the request was successful.
     */
    public function isSuccessful(): bool
    {
        return ($this->attributes['code'] ?? 0) === 0;
    }

    /**
     * Returns the response code.
     */
    public function code(): int
    {
        return $this->attributes['code'] ?? 0;
    }

    /**
     * Returns the error message if any.
     */
    public function message(): ?string
    {
        return $this->attributes['message'] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}