<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Chunks;

/**
 * @implements ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class ListResponse extends BaseResponse
{
    /**
     * @param array{code?: int, message?: string, data?: array} $attributes
     */
    public static function from(array $attributes): static
    {
        return parent::from($attributes);
    }

    /**
     * Returns the chunks list.
     */
    public function data(): array
    {
        return $this->attributes['data']['chunks'] ?? [];
    }

    /**
     * Returns the total number of chunks.
     */
    public function total(): int
    {
        return $this->attributes['data']['total'] ?? 0;
    }

    /**
     * Returns the document info.
     */
    public function doc(): array
    {
        return $this->attributes['data']['doc'] ?? [];
    }
}