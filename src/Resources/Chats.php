<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\ChatsContract;
use RAGFlow\Responses\Chats\CreateResponse;
use RAGFlow\Responses\Chats\CreateStreamedResponse;
use RAGFlow\Responses\Chats\DeleteResponse;
use RAGFlow\Responses\Chats\ListResponse;
use RAGFlow\Responses\Chats\UpdateResponse;
use RAGFlow\Responses\StreamResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Chats implements ChatsContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /**
     * 创建聊天助手
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $payload = Payload::create("chats", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }

    /**
     * 创建流式聊天助手
     * 
     * @param array<string, mixed> $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create("chats", $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }

    /**
     * 获取指定聊天助手的信息
     */
    public function get(string $chatId, array $parameters = []): array
    {
        $parameters['id'] = $chatId;
        $response = $this->list($parameters);
        if(!isset($response['data'][0])){
            return [];
        }
        return $response['data'][0];
    }

    /**
     * 列出聊天助手
     */
    public function list(array $parameters = []): ListResponse
    {
        $payload = Payload::list("chats", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    /**
     * 删除聊天助手
     */
    public function delete(array $parameters): DeleteResponse
    {
        $payload = Payload::delete("chats", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }

    /**
     * 更新聊天助手配置
     */
    public function update(string $chatId, array $parameters): UpdateResponse
    {
        $payload = Payload::modify("chats", $chatId, $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }
}