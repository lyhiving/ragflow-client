<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\ThreadsMessagesContract;
use RAGFlow\Responses\Threads\Messages\ThreadMessageDeleteResponse;
use RAGFlow\Responses\Threads\Messages\ThreadMessageListResponse;
use RAGFlow\Responses\Threads\Messages\ThreadMessageResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class ThreadsMessages implements ThreadsMessagesContract
{
    use Concerns\Transportable;

    /**
     * Create a message.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#messages/createMessage
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $threadId, array $parameters): ThreadMessageResponse
    {
        $payload = Payload::create("threads/$threadId/messages", $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_url', image_url: array{url: string, detail?: string}}|array{type: 'image_file', image_file: array{file_id: string, detail?: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, attachments?: array<int, array{file_id: string, tools: array<int, array{type: 'file_search'}|array{type: 'code_interpreter'}>}>, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Retrieve a message.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#messages/getMessage
     */
    public function retrieve(string $threadId, string $messageId): ThreadMessageResponse
    {
        $payload = Payload::retrieve("threads/$threadId/messages", $messageId);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_url', image_url: array{url: string, detail?: string}}|array{type: 'image_file', image_file: array{file_id: string, detail?: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, attachments?: array<int, array{file_id: string, tools: array<int, array{type: 'file_search'}|array{type: 'code_interpreter'}>}>, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Modifies a message.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#messages/modifyMessage
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $threadId, string $messageId, array $parameters): ThreadMessageResponse
    {
        $payload = Payload::modify("threads/$threadId/messages", $messageId, $parameters);

        /** @var Response<array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_url', image_url: array{url: string, detail?: string}}|array{type: 'image_file', image_file: array{file_id: string, detail?: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, attachments?: array<int, array{file_id: string, tools: array<int, array{type: 'file_search'}|array{type: 'code_interpreter'}>}>, metadata: array<string, string>}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageResponse::from($response->data(), $response->meta());
    }

    /**
     * Deletes a message.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#messages/deleteMessage
     */
    public function delete(string $threadId, string $messageId): ThreadMessageDeleteResponse
    {
        $payload = Payload::delete("threads/$threadId/messages", $messageId);

        /** @var Response<array{id: string, object: string, deleted: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageDeleteResponse::from($response->data(), $response->meta());
    }

    /**
     * Returns a list of messages for a given thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#messages/listMessages
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, array $parameters = []): ThreadMessageListResponse
    {
        $payload = Payload::list("threads/$threadId/messages", $parameters);

        /** @var Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, thread_id: string, role: string, content: array<int, array{type: 'image_url', image_url: array{url: string, detail?: string}}|array{type: 'image_file', image_file: array{file_id: string, detail?: string}}|array{type: 'text', text: array{value: string, annotations: array<int, array{type: 'file_citation', text: string, file_citation: array{file_id: string, quote?: string}, start_index: int, end_index: int}|array{type: 'file_path', text: string, file_path: array{file_id: string}, start_index: int, end_index: int}>}}>, assistant_id: ?string, run_id: ?string, attachments?: array<int, array{file_id: string, tools: array<int, array{type: 'file_search'}|array{type: 'code_interpreter'}>}>, metadata: array<string, string>}>, first_id: ?string, last_id: ?string, has_more: bool}> $response */
        $response = $this->transporter->requestObject($payload);

        return ThreadMessageListResponse::from($response->data(), $response->meta());
    }
}
