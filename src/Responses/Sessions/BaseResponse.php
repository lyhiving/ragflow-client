<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>
 */
abstract class BaseResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}  $attributes
     */
    final public function __construct(
        public readonly array $attributes,
    ) {
    }

    /**
     * 获取会话ID
     */
    public function id(): string
    {
        return $this->attributes['id'];
    }

    /**
     * 获取聊天助手ID
     */
    public function chatId(): string
    {
        return $this->attributes['chat_id'];
    }

    /**
     * 获取会话名称
     */
    public function name(): string
    {
        return $this->attributes['name'];
    }

    /**
     * 获取创建时间
     */
    public function createTime(): int
    {
        return $this->attributes['create_time'];
    }

    /**
     * 获取创建日期
     */
    public function createDate(): string
    {
        return $this->attributes['create_date'];
    }

    /**
     * 获取更新时间
     */
    public function updateTime(): int
    {
        return $this->attributes['update_time'];
    }

    /**
     * 获取更新日期
     */
    public function updateDate(): string
    {
        return $this->attributes['update_date'];
    }

    /**
     * 获取消息列表
     */
    public function messages(): array
    {
        return $this->attributes['messages'];
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}