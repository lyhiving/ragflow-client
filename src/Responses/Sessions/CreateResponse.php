<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

/**
 * @implements ResponseContract<array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>
 */
final class CreateResponse extends BaseResponse
{
    /**
     * 从响应数据创建实例
     *
     * @param  array{code: int, data: array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes['data']);
    }

    /**
     * 检查会话是否创建成功
     */
    public function isCreated(): bool
    {
        return !empty($this->attributes['id']);
    }

    /**
     * 获取初始消息
     */
    public function getInitialMessage(): ?array
    {
        $messages = $this->messages();
        return !empty($messages) ? $messages[0] : null;
    }
}