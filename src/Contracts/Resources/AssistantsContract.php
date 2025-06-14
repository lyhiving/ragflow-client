<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Assistants\AssistantDeleteResponse;
use RAGFlow\Responses\Assistants\AssistantListResponse;
use RAGFlow\Responses\Assistants\AssistantResponse;

interface AssistantsContract
{
    /**
     * Create an assistant with a model and instructions.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/createAssistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AssistantResponse;

    /**
     * Retrieves an assistant.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/getAssistant
     */
    public function retrieve(string $id): AssistantResponse;

    /**
     * Modifies an assistant.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/modifyAssistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): AssistantResponse;

    /**
     * Delete an assistant.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/deleteAssistant
     */
    public function delete(string $id): AssistantDeleteResponse;

    /**
     * Returns a list of assistants.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/listAssistants
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AssistantListResponse;
}
