<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Agents;

final class ListResponse extends BaseResponse
{
    /**
     * 获取代理列表
     *
     * @return array<int, array{
     *   id: string,
     *   title: string,
     *   description: ?string,
     *   dsl: array,
     *   create_time: int,
     *   update_time: int,
     *   user_id: string,
     *   create_date: string,
     *   update_date: string
     * }>
     */
    public function getAgents(): array
    {
        $data = $this->getData();
        return is_array($data) ? $data : [];
    }

    /**
     * 获取代理列表 (别名)
     */
    public function agents(): array
    {
        return $this->getAgents();
    }
}