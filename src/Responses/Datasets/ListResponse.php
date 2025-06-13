<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Datasets;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array<int, array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>>
 */
final class ListResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array<int, array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>  $attributes
     */
    private function __construct(
        private readonly array $attributes,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{data: array<int, array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes['data'] ?? []);
    }

    /**
     * Returns the list of datasets.
     *
     * @return array<int, array{id: string, name: string, avatar: string, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>
     */
    public function data(): array
    {
        return $this->attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}