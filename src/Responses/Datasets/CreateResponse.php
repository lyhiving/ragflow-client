<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Datasets;

/**
 * @implements \RAGFlow\Contracts\ResponseContract<array{code?: int, message?: string, data?: array}>
 */
final class CreateResponse extends BaseResponse
{
    /**
     * Returns the dataset data if successful.
     */
    public function data(): ?array
    {
        return $this->isSuccess() ? ($this->attributes['data'] ?? null) : null;
    }

    /**
     * Returns the dataset ID.
     */
    public function id(): ?string
    {
        $data = $this->data();
        return $data['id'] ?? null;
    }

    /**
     * Returns the dataset name.
     */
    public function name(): ?string
    {
        $data = $this->data();
        return $data['name'] ?? null;
    }

    /**
     * Returns the dataset avatar.
     */
    public function avatar(): ?string
    {
        $data = $this->data();
        return $data['avatar'] ?? null;
    }

    /**
     * Returns the dataset description.
     */
    public function description(): ?string
    {
        $data = $this->data();
        return $data['description'] ?? null;
    }

    /**
     * Returns the embedding model.
     */
    public function embeddingModel(): ?string
    {
        $data = $this->data();
        return $data['embedding_model'] ?? null;
    }

    /**
     * Returns the dataset permission.
     */
    public function permission(): ?string
    {
        $data = $this->data();
        return $data['permission'] ?? null;
    }

    /**
     * Returns the chunk method.
     */
    public function chunkMethod(): ?string
    {
        $data = $this->data();
        return $data['chunk_method'] ?? null;
    }

    /**
     * Returns the parser configuration.
     */
    public function parserConfig(): ?array
    {
        $data = $this->data();
        return $data['parser_config'] ?? null;
    }

    /**
     * Returns the creation date.
     */
    public function createDate(): ?string
    {
        $data = $this->data();
        return $data['create_date'] ?? null;
    }

    /**
     * Returns the creation time.
     */
    public function createTime(): ?int
    {
        $data = $this->data();
        return $data['create_time'] ?? null;
    }

    /**
     * Returns the creator ID.
     */
    public function createdBy(): ?string
    {
        $data = $this->data();
        return $data['created_by'] ?? null;
    }

    /**
     * Returns the document count.
     */
    public function documentCount(): ?int
    {
        $data = $this->data();
        return $data['document_count'] ?? null;
    }

    /**
     * Returns the chunk count.
     */
    public function chunkCount(): ?int
    {
        $data = $this->data();
        return $data['chunk_count'] ?? null;
    }

    /**
     * Returns the language.
     */
    public function language(): ?string
    {
        $data = $this->data();
        return $data['language'] ?? null;
    }

    /**
     * Returns the page rank.
     */
    public function pagerank(): ?int
    {
        $data = $this->data();
        return $data['pagerank'] ?? null;
    }

    /**
     * Returns the similarity threshold.
     */
    public function similarityThreshold(): ?float
    {
        $data = $this->data();
        return $data['similarity_threshold'] ?? null;
    }

    /**
     * Returns the status.
     */
    public function status(): ?string
    {
        $data = $this->data();
        return $data['status'] ?? null;
    }

    /**
     * Returns the tenant ID.
     */
    public function tenantId(): ?string
    {
        $data = $this->data();
        return $data['tenant_id'] ?? null;
    }

    /**
     * Returns the token number.
     */
    public function tokenNum(): ?int
    {
        $data = $this->data();
        return $data['token_num'] ?? null;
    }

    /**
     * Returns the update date.
     */
    public function updateDate(): ?string
    {
        $data = $this->data();
        return $data['update_date'] ?? null;
    }

    /**
     * Returns the update time.
     */
    public function updateTime(): ?int
    {
        $data = $this->data();
        return $data['update_time'] ?? null;
    }

    /**
     * Returns the vector similarity weight.
     */
    public function vectorSimilarityWeight(): ?float
    {
        $data = $this->data();
        return $data['vector_similarity_weight'] ?? null;
    }
}