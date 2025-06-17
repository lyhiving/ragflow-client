<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Agents;

final class CreateResponse extends BaseResponse
{
    /**
     * 获取代理ID
     */
    public function getId(): string
    {
        $data = $this->getData();
        return $data['id'] ?? '';
    }

    /**
     * 获取代理标题
     */
    public function getTitle(): string
    {
        $data = $this->getData();
        return $data['title'] ?? '';
    }

    /**
     * 获取代理描述
     */
    public function getDescription(): ?string
    {
        $data = $this->getData();
        return $data['description'] ?? null;
    }

    /**
     * 获取DSL配置
     */
    public function getDsl(): array
    {
        $data = $this->getData();
        return $data['dsl'] ?? [];
    }

    /**
     * 获取代理ID (别名)
     */
    public function id(): string
    {
        return $this->getId();
    }

    /**
     * 获取代理标题 (别名)
     */
    public function title(): string
    {
        return $this->getTitle();
    }

    /**
     * 获取代理描述 (别名)
     */
    public function description(): ?string
    {
        return $this->getDescription();
    }

    /**
     * 获取DSL配置 (别名)
     */
    public function dsl(): array
    {
        return $this->getDsl();
    }
}