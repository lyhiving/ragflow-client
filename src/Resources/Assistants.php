<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\AssistantsContract;
use RAGFlow\Responses\Assistants\CreateResponse;
use RAGFlow\Responses\Assistants\CreateStreamedResponse;
use RAGFlow\Responses\Assistants\DeleteResponse;
use RAGFlow\Responses\Assistants\ListResponse;
use RAGFlow\Responses\Assistants\UpdateResponse;
use RAGFlow\Responses\StreamResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Assistants implements AssistantsContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        // 使用 "chats" 而不是 "assistants" 作为资源路径
        $payload = Payload::create("chats", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        // 使用 "chats" 而不是 "assistants" 作为资源路径
        $payload = Payload::create("chats", $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }

    public function list(array $parameters = []): ListResponse
    {
        // 使用 "chats" 而不是 "assistants" 作为资源路径
        $payload = Payload::list("chats", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    public function delete(array $parameters): DeleteResponse
    {
        // 使用 "chats" 而不是 "assistants" 作为资源路径
        $payload = Payload::delete("chats", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }

    public function update(string $assistantId, array $parameters): UpdateResponse
    {
        // 使用 "chats" 而不是 "assistants" 作为资源路径
        $payload = Payload::modify("chats", $assistantId, $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }

    /**
     * 获取指定助手的信息
     */
    public function get(string $assistantId, array $parameters = []): array
    {
        $parameters['id'] = $assistantId;
        $response = $this->list($parameters);
        if (!isset($response['data'][0])) {
            return [];
        }
        return $response['data'][0];
    }

    
    public function getOne(array $conditions): ?array
    {
        $parameters = [];
        foreach ($conditions as $key => $value) {
            $parameters[$key] = $value;
        }

        $response = $this->list($parameters);
        if (!isset($response['data'][0])) {
            return [];
        }
        return $response['data'][0];
    }
}
