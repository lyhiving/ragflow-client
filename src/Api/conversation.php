<?php
namespace lyhiving\ragflow\Api;
class conversation extends abstractApi {
    public function completion(string $kbId, string $question, ?string $conversationId = null, bool $stream = false): array {
        $payload = ['kb_id' => $kbId, 'question' => $question, 'stream' => $stream];
        if ($conversationId) $payload['conversation_id'] = $conversationId;
        return $this->client->post('completion', $payload);
    }
    public function getHistory(string $conversationId): array { return $this->client->get("conversation/{$conversationId}"); }
}