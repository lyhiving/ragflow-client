<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Chunks;

/**
 * @implements ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class CreateResponse extends BaseResponse
{
    /**
     * @param array{code?: int, message?: string, data?: array} $attributes
     */
    public static function from(array $attributes): static
    {
        return parent::from($attributes);
    }

    /**
     * Returns the response data.
     */
    public function data(): array
    {
        return $this->attributes['data'] ?? [];
    }
}