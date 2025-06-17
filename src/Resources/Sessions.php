<?php

declare(strict_types=1);

namespace RAGFlow\Resources;

use RAGFlow\Contracts\Resources\SessionsContract;
use RAGFlow\Responses\Sessions\CreateResponse;
use RAGFlow\Responses\Sessions\CreateStreamedResponse;
use RAGFlow\Responses\Sessions\DeleteResponse;
use RAGFlow\Responses\Sessions\ListResponse;
use RAGFlow\Responses\Sessions\UpdateResponse;
use RAGFlow\Responses\StreamResponse;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\Response;

final class Sessions implements SessionsContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    public function create(string $chatId, array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        // 使用 "chats/{chat_id}/sessions" 作为资源路径
        $payload = Payload::create("chats/{$chatId}/sessions", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data());
    }

    public function createStreamed(string $chatId, array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        // 使用 "chats/{chat_id}/sessions" 作为资源路径
        $payload = Payload::create("chats/{$chatId}/sessions", $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }

    public function list(string $chatId, array $parameters = []): ListResponse
    {
        // 使用 "chats/{chat_id}/sessions" 作为资源路径
        $payload = Payload::list("chats/{$chatId}/sessions", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }

    public function delete(string $chatId, array $parameters): DeleteResponse
    {
        // 使用 "chats/{chat_id}/sessions" 作为资源路径
        $payload = Payload::delete("chats/{$chatId}/sessions", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return DeleteResponse::from($response->data());
    }

    public function update(string $chatId, string $sessionId, array $parameters): UpdateResponse
    {
        // 使用 "chats/{chat_id}/sessions/{session_id}" 作为资源路径
        $payload = Payload::modify("chats/{$chatId}/sessions", $sessionId, $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return UpdateResponse::from($response->data());
    }

    /**
     * 获取指定会话的信息
     */
    public function get(string $chatId, string $sessionId, array $parameters = []): array
    {
        $parameters['id'] = $sessionId;
        $response = $this->list($chatId, $parameters);
        $data = $response->data();
        if (!isset($data[0])) {
            return [];
        }
        return $data[0];
    }

    /**
     * 与聊天助手对话
     */
    public function converse(string $chatId, array $parameters): array
    {
        // 使用 "chats/{chat_id}/completions" 作为资源路径
        $payload = Payload::create("chats/{$chatId}/completions", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        return $response->data();
    }

    /**
     * 与聊天助手流式对话
     */
    public function converseStreamed(string $chatId, array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        // 使用 "chats/{chat_id}/completions" 作为资源路径
        $payload = Payload::create("chats/{$chatId}/completions", $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }

    /**
     * 生成相关问题
     */
    public function relatedQuestions(array $parameters): array
    {
            /**
     * 生成相关问题
     * 
     * @param array<string, mixed> $parameters
     * @return array<int, string> 返回相关问题列表
     */
    public function relatedQuestions(array $parameters): array
    {
        // 使用 "sessions/related_questions" 作为资源路径
        $payload = Payload::create("sessions/related_questions", $parameters);

        /** @var Response<array> $response */
        $response = $this->transporter->requestObject($payload);

        $data = $response->data();
        return isset($data['data']) ? $data['data'] : [];
    }

    /**
     * 发送流式消息
     *
     * @param string $chatId 聊天助手ID
     * @param string $sessionId 会话ID  
     * @param string $message 消息内容
     * @param array<string, mixed> $parameters 其他参数
     */
    public function sendStreamMessage(string $chatId, string $sessionId, string $message, array $parameters = []): StreamResponse
    {
        $parameters = array_merge($parameters, [
            'question' => $message,
            'stream' => true,
            'session_id' => $sessionId
        ]);

        return $this->converseStreamed($chatId, $parameters);
    }

    /**
     * 发送普通消息
     *
     * @param string $chatId 聊天助手ID
     * @param string $sessionId 会话ID
     * @param string $message 消息内容
     * @param array<string, mixed> $parameters 其他参数 
     */
    public function sendMessage(string $chatId, string $sessionId, string $message, array $parameters = []): array
    {
        $parameters = array_merge($parameters, [
            'question' => $message,
            'stream' => false,
            'session_id' => $sessionId
        ]);

        return $this->converse($chatId, $parameters);
    }

    /**
     * 获取历史消息
     *
     * @param string $chatId 聊天助手ID
     * @param string $sessionId 会话ID
     * @return array<int, array{role: string, content: string}> 返回历史消息列表
     */
    public function getHistory(string $chatId, string $sessionId): array 
    {
        $session = $this->get($chatId, $sessionId);
        return isset($session['messages']) ? $session['messages'] : [];
    }

    /**
     * 清空历史消息
     *
     * @param string $chatId 聊天助手ID
     * @param string $sessionId 会话ID
     */
    public function clearHistory(string $chatId, string $sessionId): UpdateResponse
    {
        return $this->update($chatId, $sessionId, [
            'messages' => []
        ]);
    }

    /**
     * 重置会话
     * 
     * @param string $chatId 聊天助手ID
     * @param string $sessionId 会话ID
     */
    public function resetSession(string $chatId, string $sessionId): bool
    {
        // 先删除旧会话
        $this->delete($chatId, ['ids' => [$sessionId]]);

        // 创建新会话
        $response = $this->create($chatId, [
            'id' => $sessionId
        ]);

        return $response->isCreated();
    }
}