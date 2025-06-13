<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Datasets;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: string, name: string, avatar: string|null, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, pagerank: int, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>
 */
final class CreateResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, name: string, avatar: string|null, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, pagerank: int, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}>
     */
    use ArrayAccessible;

    /**
     * @param  array{id: string, name: string, avatar: string|null, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, pagerank: int, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}  $attributes
     */
    private function __construct(
        private readonly array $attributes,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, name: string, avatar: string|null, description: string|null, embedding_model: string, permission: string, chunk_method: string, parser_config: array, create_date: string, create_time: int, created_by: string, document_count: int, chunk_count: int, language: string, pagerank: int, similarity_threshold: float, status: string, tenant_id: string, token_num: int, update_date: string, update_time: int, vector_similarity_weight: float}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * Returns the dataset ID.
     */
    public function id(): string
    {
        return $this->attributes['id'];
    }

    /**
     * Returns the dataset name.
     */
    public function name(): string
    {
        return $this->attributes['name'];
    }

    /**
     * Returns the dataset avatar.
     */
    public function avatar(): ?string
    {
        return $this->attributes['avatar'];
    }

    /**
     * Returns the dataset description.
     */
    public function description(): ?string
    {
        return $this->attributes['description'];
    }

    /**
     * Returns the embedding model.
     */
    public function embeddingModel(): string
    {
        return $this->attributes['embedding_model'];
    }

    /**
     * Returns the dataset permission.
     */
    public function permission(): string
    {
        return $this->attributes['permission'];
    }

    /**
     * Returns the chunk method.
     */
    public function chunkMethod(): string
    {
        return $this->attributes['chunk_method'];
    }

    /**
     * Returns the parser configuration.
     */
    public function parserConfig(): array
    {
        return $this->attributes['parser_config'];
    }

    /**
     * Returns the creation date.
     */
    public function createDate(): string
    {
        return $this->attributes['create_date'];
    }

    /**
     * Returns the creation time.
     */
    public function createTime(): int
    {
        return $this->attributes['create_time'];
    }

    /**
     * Returns the creator ID.
     */
    public function createdBy(): string
    {
        return $this->attributes['created_by'];
    }

    /**
     * Returns the document count.
     */
    public function documentCount(): int
    {
        return $this->attributes['document_count'];
    }

    /**
     * Returns the chunk count.
     */
    public function chunkCount(): int
    {
        return $this->attributes['chunk_count'];
    }

    /**
     * Returns the language.
     */
    public function language(): string
    {
        return $this->attributes['language'];
    }

    /**
     * Returns the page rank.
     */
    public function pagerank(): int
    {
        return $this->attributes['pagerank'];
    }

    /**
     * Returns the similarity threshold.
     */
    public function similarityThreshold(): float
    {
        return $this->attributes['similarity_threshold'];
    }

    /**
     * Returns the status.
     */
    public function status(): string
    {
        return $this->attributes['status'];
    }

    /**
     * Returns the tenant ID.
     */
    public function tenantId(): string
    {
        return $this->attributes['tenant_id'];
    }

    /**
     * Returns the token number.
     */
    public function tokenNum(): int
    {
        return $this->attributes['token_num'];
    }

    /**
     * Returns the update date.
     */
    public function updateDate(): string
    {
        return $this->attributes['update_date'];
    }

    /**
     * Returns the update time.
     */
    public function updateTime(): int
    {
        return $this->attributes['update_time'];
    }

    /**
     * Returns the vector similarity weight.
     */
    public function vectorSimilarityWeight(): float
    {
        return $this->attributes['vector_similarity_weight'];
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}