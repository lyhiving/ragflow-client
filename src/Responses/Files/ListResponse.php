<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Files;

use RAGFlow\Responses\Concerns\ArrayAccessible; 

/**
 * @implements \RAGFlow\Contracts\ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class ListResponse extends BaseResponse
{
    /**
     * @use ArrayAccessible<array{code?: int, message?: string, data?: array}>
     */
    use ArrayAccessible;

    /**
     * @param array{code?: int, message?: string, data?: array} $attributes
     */
    private function __construct(
        protected readonly array $attributes
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
     * Returns the list of files.
     */
    public function data(): array
    {
        return $this->isSuccess() ? ($this->attributes['data']['docs'] ?? []) : [];
    }

    /**
     * Returns total count.
     */ 
    public function total(): int
    {
        return $this->isSuccess() ? ($this->attributes['data']['total'] ?? 0) : 0;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array 
    {
        return $this->attributes;
    }
}
