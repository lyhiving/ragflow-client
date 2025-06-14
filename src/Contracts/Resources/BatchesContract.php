<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Batches\BatchListResponse;
use RAGFlow\Responses\Batches\BatchResponse;

interface BatchesContract
{
    /**
     * Creates and executes a batch from an uploaded file of requests
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#batch/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): BatchResponse;

    /**
     * Retrieves a batch.
     * *
     * @see https://ragflow.io/docs/dev/http_api_reference#batch/retrieve
     */
    public function retrieve(string $id): BatchResponse;

    /**
     * Cancels an in-progress batch.
     * *
     * @see https://ragflow.io/docs/dev/http_api_reference#batch/cancel
     */
    public function cancel(string $id): BatchResponse;

    /**
     * List your organization's batches.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#batch/list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): BatchListResponse;
}
