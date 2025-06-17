<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array}>
 */
final class CreateStreamedResponse extends BaseResponse
{
    use ArrayAccessible;

    /**
     * @param array{id: string, chat_id: string, name: string, create_time: int, create_date: string, update_time: int, update_date: string, messages: array} $attributes
     */
    protected array $attributes; // 修改为 protected

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes; // 直接赋值
    }

    /**
     * 从API响应创建实例
     *
     * @param array{code: int, data: array} $response
     */
    public static function from(array $response): static
    {
        return new static($response['data']);
    }

    /**
     * 检查响应是否成功
     */
    public function isSuccess(): bool
    {
        return isset($this->attributes['id']);
    }

    /**
     * 获取响应代码
     */
    public function code(): int
    {
        return 0; // 假设成功时返回0
    }

    /**
     * 获取响应消息
     */
    public function message(): string
    {
        return ''; // 假设成功时没有消息
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->attributes;
    }
}