<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Embeddings\CreateResponse;

interface EmbeddingsContract
{
    /**
     * Creates an embedding vector representing the input text.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#embeddings/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
