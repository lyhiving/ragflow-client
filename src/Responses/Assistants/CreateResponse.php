<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Assistants;

final class CreateResponse extends BaseResponse
{
     /**
     * 获取创建的聊天助手ID
     */
    public function id(): ?string
    {
        return $this->getId();
    }

    /**
     * 获取创建的聊天助手ID
     */
    public function getId(): ?string
    {
        $data = $this->getData();
        return is_array($data) ? ($data['id'] ?? null) : null;
    }

    /**
     * 获取聊天助手名称
     */
    public function getName(): ?string
    {
        $data = $this->getData();
        return is_array($data) ? ($data['name'] ?? null) : null;
    }

    /**
     * 获取数据集IDs
     */
    public function getDatasetIds(): array
    {
        $data = $this->getData();
        return is_array($data) ? ($data['dataset_ids'] ?? []) : [];
    }

    /**
     * 获取LLM配置
     */
    public function getLlmConfig(): array
    {
        $data = $this->getData();
        return is_array($data) ? ($data['llm'] ?? []) : [];
    }

    /**
     * 获取Prompt配置
     */
    public function getPromptConfig(): array
    {
        $data = $this->getData();
        return is_array($data) ? ($data['prompt'] ?? []) : [];
    }

    /**
     * 获取创建时间
     */
    public function getCreateTime(): ?int
    {
        $data = $this->getData();
        return is_array($data) ? ($data['create_time'] ?? null) : null;
    }

    /**
     * 获取创建日期
     */
    public function getCreateDate(): ?string
    {
        $data = $this->getData();
        return is_array($data) ? ($data['create_date'] ?? null) : null;
    }
}