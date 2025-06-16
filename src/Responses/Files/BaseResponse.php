<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Files;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{code?: int, message?: string, data?: array}>
 */
abstract class BaseResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{code?: int, message?: string, data?: array}>
     */
    use ArrayAccessible;
    use Fakeable;

    /**
     * @param array{code?: int, message?: string, data?: array} $attributes
     */
    private function __construct(
        protected readonly array $attributes,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{code?: int, message?: string, data?: array} $attributes
     */
    public static function from(array $attributes): static
    {
        return new static($attributes);
    }

    /**
     * Returns the response code.
     */
    public function code(): ?int
    {
        return $this->attributes['code'] ?? null;
    }

    /**
     * Returns the response message.
     */
    public function message(): ?string
    {
        return $this->attributes['message'] ?? null;
    }

    /**
     * Checks if the response is successful.
     */
    public function isSuccessful(): bool
    {
        return ($this->attributes['code'] ?? null) === 0;
    }

    /**
     * Checks if the response has an error.
     */
    public function hasError(): bool
    {
        return !$this->isSuccessful();
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}