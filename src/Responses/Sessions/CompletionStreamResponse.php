<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

/**
 * @implements ResponseContract<array{answer: string, reference: array, audio_binary: ?string, id: ?string, session_id: string}>
 */
final class CompletionStreamResponse extends BaseCompletionResponse
{
    /**
     * 从API响应创建实例
     *
     * @param array{code: int, data: mixed} $response
     */
    public static function from(array $response): static
    {
        // 处理结束消息
        if (isset($response['data']) && $response['data'] === true) {
            return new static([
                'answer' => '',
                'reference' => [],
                'session_id' => '',
                'id' => null,
                'audio_binary' => null
            ]);
        }

        return new static($response['data']);
    }

    /**
     * 检查是否是结束消息
     */
    public function isEnd(): bool
    {
        return empty($this->attributes['answer']);
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return true; // 流式响应只要收到就是成功的
    }
}