<?php
namespace lyhiving\ragflow\Api;
class apiKey extends abstractApi {
    public function create(int $tenancyLevel, ?string $name = null): array {
        $payload = ['tenancy_level' => $tenancyLevel]; if ($name) $payload['name'] = $name;
        return $this->client->post('api_key/create', $payload);
    }
    public function get(): array { return $this->client->get('api_key/get'); }
    public function delete(string $apiKeyString): array { return $this->client->delete('api_key/delete', ['api_key' => $apiKeyString]); }
}