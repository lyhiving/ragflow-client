<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Datasets;

/**
 * @implements \RAGFlow\Contracts\ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class ListResponse extends BaseResponse
{
    /**
     * Returns the list of datasets.
     */
    public function data(): array
    {
        return $this->isSuccess() ? ($this->attributes['data'] ?? []) : [];
    }
}