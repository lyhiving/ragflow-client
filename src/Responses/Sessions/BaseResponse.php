<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{
 *     chat_id: string,
 *     create_date: string,
 *     create_time: int,
 *     id: string,
 *     messages: array<int, array{content: string, role: string}>,
 *     name: string,
 *     update_date: string,
 *     update_time: int
 * }>
 */
abstract class BaseResponse implements ResponseContract
{
    use ArrayAccessible;

    /**
     * @param array{
     *     chat_id: string,
     *     create_date: string,
     *     create_time: int,
     *     id: string,
     *     messages: array<int, array{content: string, role: string}>,
     *     name: string,
     *     update_date: string,
     *     update_time: int
     * } $attributes
     */
    public function __construct(
        protected array $attributes
    ) {
    }

    /**
     * 从API响应创建实例
     */
    abstract public static function from(array $response): static;

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
     * 获取创建时间戳
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
     * 获取更新时间戳
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
     * 获取会话消息列表
     * 
     * @return array<int, array{content: string, role: string}>
     */
    public function messages(): array
    {
        return $this->attributes['messages'] ?? [];
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}