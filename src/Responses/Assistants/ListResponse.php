<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Assistants;

final class ListResponse extends BaseResponse
{
    /**
     * 获取聊天助手列表
     */
    public function getAssistants(): array
    {
        $data = $this->getData();
        return is_array($data) ? $data : [];
    }

    /**
     * 获取聊天助手数量
     */
    public function getCount(): int
    {
        return count($this->getAssistants());
    }

    /**
     * 检查是否有聊天助手
     */
    public function hasAssistants(): bool
    {
        return $this->getCount() > 0;
    }
}