<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Files;

use RAGFlow\Responses\Datasets\BaseResponse;

/**
 * @implements \RAGFlow\Contracts\ResponseContract<array{code?: int, message?: string}>
 */
final class UpdateResponse extends BaseResponse
{
        /**
     * Returns the list of datasets.
     */
    public function data(): array
    {
        return $this->isSuccess() ? ($this->attributes['data'] ?? []) : [];
    }
}