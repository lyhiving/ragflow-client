<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 13:04:37
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 16:46:04
 * @FilePath: /RAGFlow-php-client/src/Resources/Assistants.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\AssistantsContract;
use RAGFlow\Responses\Assistants\AssistantDeleteResponse;
use RAGFlow\Responses\Assistants\AssistantListResponse;
use RAGFlow\Responses\Assistants\AssistantResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Assistants implements AssistantsContract
{
    use Concerns\Transportable;

    /**
     * Create an assistant with a model and instructions.
     *
     * @see http://ragflow.server:9280/user-setting/api#create-chat-assistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): AssistantResponse
    {
        $payload = Payload::create('assistants', $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieves an assistant.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/getAssistant
     */
    public function retrieve(string $id): AssistantResponse
    {
        $payload = Payload::retrieve('assistants', $id);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies an assistant.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/modifyAssistant
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): AssistantResponse
    {
        $payload = Payload::modify('assistants', $id, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantResponse::from($response->data(), $response->meta());
    }

    /**
     * Delete an assistant.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/deleteAssistant
     */
    public function delete(string $id): AssistantDeleteResponse
    {
        $payload = Payload::delete('assistants', $id);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of assistants.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#assistants/listAssistants
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): AssistantListResponse
    {
        $payload = Payload::list('assistants', $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: string, name: string, parameters: array<string, mixed>}}>, tool_resources: array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return AssistantListResponse::from($response->data(), $response->meta());
    }
}
