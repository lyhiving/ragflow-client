<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Files;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class CreateResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{code?: int, message?: string, data?: array}>
     */
    use ArrayAccessible;

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
    public function isSuccess(): bool
    {
        return ($this->attributes['code'] ?? null) === 0;
    }

    /**
     * Returns the uploaded document data.
     */
    public function data(): ?array
    {
        return $this->isSuccess() ? ($this->attributes['data'][0] ?? null) : null;
    }

    /**
     * Returns the document ID.
     */
    public function documentId(): ?string
    {
        $data = $this->data();
        return $data['id'] ?? null; // Assuming the first document is returned
    }

    /**
     * Returns the document name.
     */
    public function documentName(): ?string
    {
        $data = $this->data();
        return $data['name'] ?? null; // Assuming the first document is returned
    }

    /**
     * Returns the document size.
     */
    public function documentSize(): ?int
    {
        $data = $this->data();
        return $data['size'] ?? null; // Assuming the first document is returned
    }

    /**
     * Returns the document type.
     */
    public function documentType(): ?string
    {
        $data = $this->data();
        return $data['type'] ?? null; // Assuming the first document is returned
    }

    

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}