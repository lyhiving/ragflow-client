<?php

namespace RAGFlow\Contracts;

use RAGFlow\Contracts\Resources\AssistantsContract;
use RAGFlow\Contracts\Resources\ChatContract;
use RAGFlow\Contracts\Resources\ChunksContract;
use RAGFlow\Contracts\Resources\DatasetsContract;
use RAGFlow\Contracts\Resources\CompletionsContract;
use RAGFlow\Contracts\Resources\FilesContract;

interface ClientContract
{
    /**
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#completions
     */
    public function completions(): CompletionsContract;

    /**
     * Given a chat conversation, the model will return a chat completion response.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#chat
     */
    public function chat(): ChatContract;


    /**
     * Files are used to upload documents that can be used with features like Fine-tuning.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#files
     */
    public function chunks(): ChunksContract;


    /**
     * Files are used to upload documents that can be used with features like Fine-tuning.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#files
     */
    public function files(): FilesContract;

    /**
     * List and describe the various models available in the API.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#models
     */
    public function datasets(): DatasetsContract;
}
