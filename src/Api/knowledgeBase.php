<?php
namespace lyhiving\ragflow\Api;
class knowledgeBase extends abstractApi {
    public function create(string $name): array { return $this->client->post('kb/create', ['name' => $name]); }
    public function list(): array { return $this->client->get('kb/list'); }
    public function get(string $kbId): array { return $this->client->get("kb/detail/{$kbId}"); }
    public function update(string $kbId, array $params): array { return $this->client->post('kb/update', array_merge(['id' => $kbId], $params)); }
    public function delete(string $kbId): array { return $this->client->delete('kb/delete', ['kb_id' => $kbId]); }
}