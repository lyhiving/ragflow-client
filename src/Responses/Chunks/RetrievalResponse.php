<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Chunks;

/**
 * @implements ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class RetrievalResponse extends BaseResponse
{
    /**
     * @param array{code?: int, message?: string, data?: array} $attributes
     */
    public static function from(array $attributes): static
    {
        return parent::from($attributes);
    }

    /**
     * Returns the retrieved chunks.
     */
    public function chunks(): array
    {
        return $this->attributes['data']['chunks'] ?? [];
    }

    /**
     * Returns the document aggregations.
     */
    public function docAggs(): array
    {
        return $this->attributes['data']['doc_aggs'] ?? [];
    }

    /**
     * Returns the total number of chunks.
     */
    public function total(): int
    {
        return $this->attributes['data']['total'] ?? 0;
    }
}