<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Chat\CreateResponse;
use RAGFlow\Responses\Chat\CreateStreamedResponse;
use RAGFlow\Responses\StreamResponse;

interface ChatContract
{
    /**
     * Creates a completion for the chat message
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#chat/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * Creates a streamed completion for the chat message
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#chat/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse;
}
