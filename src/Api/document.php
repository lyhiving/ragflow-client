<?php
namespace lyhiving\ragflow\Api;
class document extends abstractApi {
    public function uploadFile(string $kbId, string $filePath): array {
        if (!file_exists($filePath) || !is_readable($filePath)) throw new \InvalidArgumentException("File not found: {$filePath}");
        $multipart = [['name' => 'kb_id', 'contents' => $kbId], ['name' => 'file', 'contents' => fopen($filePath, 'r'), 'filename' => basename($filePath)]];
        return $this->client->postMultipart('document/upload', $multipart);
    }
    public function uploadUrl(string $kbId, string $url): array { return $this->client->post('document/upload_url', ['kb_id' => $kbId, 'url' => $url]); }
    public function list(string $kbId): array { return $this->client->get("document/list/{$kbId}"); }
    public function get(string $docId): array { return $this->client->get("document/detail/{$docId}"); }
    public function update(string $docId, array $params): array { return $this->client->post('document/update', array_merge(['id' => $docId], $params)); }
    public function delete(string $docId): array { return $this->client->delete('document/delete', ['doc_id' => $docId]); }
    public function getChunks(string $docId): array { return $this->client->get("document/chunks/{$docId}"); }
}