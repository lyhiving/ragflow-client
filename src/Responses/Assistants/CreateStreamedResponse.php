<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Assistants;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

final class CreateStreamedResponse implements ResponseContract
{
    use ArrayAccessible;

    public function __construct(
        private readonly array $attributes,
    ) {
    }

    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * 获取流式响应内容
     */
    public function getContent(): ?string
    {
        if (isset($this->attributes['data']['content'])) {
            return $this->attributes['data']['content'];
        }

        return null;
    }
}