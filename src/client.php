<?php

namespace lyhiving\ragflow;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use lyhiving\ragflow\Exception\ragflowException;

/**
 * @property Api\apiKey        $apiKey
 * @property Api\knowledgeBase $knowledgeBase
 * @property Api\document      $document
 * @property Api\conversation  $conversation
 */
class client
{
    protected HttpClient $httpClient;

    public function __construct(string $apiKey, string $apiEndpoint, float $requestTimeout = 30.0)
    {
        $this->httpClient = new HttpClient([
            'base_uri' => rtrim($apiEndpoint, '/') . '/', // Use apiEndpoint
            'headers' => ['Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json'],
            'timeout' => $requestTimeout, // Use requestTimeout
        ]);
    }

    public function __get(string $name)
    {
        $classMap = [
            'apiKey'        => Api\apiKey::class,
            'knowledgeBase' => Api\knowledgeBase::class,
            'document'      => Api\document::class,
            'conversation'  => Api\conversation::class,
        ];

        if (array_key_exists($name, $classMap)) {
            return new $classMap[$name]($this);
        }
        throw new \InvalidArgumentException("Invalid API module: {$name}");
    }
    
    // ... (rest of the methods: get, post, postMultipart, delete, downloadFile, request)
    public function get(string $uri, array $params = []): array { return $this->request('GET', $uri, ['query' => $params]); }
    public function post(string $uri, array $data = []): array { return $this->request('POST', $uri, ['json' => $data]); }
    public function postMultipart(string $uri, array $multipart = []): array { return $this->request('POST', $uri, ['multipart' => $multipart]); }
    public function delete(string $uri, array $data = []): array { return $this->request('DELETE', $uri, ['json' => $data]); }
    public function downloadFile(string $fileId, string $savePath): bool {
        try {
            $response = $this->httpClient->get("file/download/{$fileId}", ['sink' => $savePath]);
            return $response->getStatusCode() === 200;
        } catch (RequestException $e) { throw new ragflowException("Failed to download file: " . $e->getMessage(), $e->getCode(), $e); }
    }
    private function request(string $method, string $uri, array $options = []): array {
        try {
            $response = $this->httpClient->request($method, $uri, $options);
            $data = json_decode((string) $response->getBody(), true);
            if (json_last_error() !== JSON_ERROR_NONE) { throw new ragflowException("Invalid JSON response: " . json_last_error_msg()); }
            if (isset($data['code']) && $data['code'] !== 0) { throw new ragflowException($data['message'] ?? 'Unknown API error', $data['code']); }
            return $data;
        } catch (RequestException $e) {
            $message = $e->getMessage();
            if ($e->hasResponse()) {
                $errorData = json_decode((string) $e->getResponse()->getBody(), true);
                $message = $errorData['message'] ?? $message;
            }
            throw new ragflowException("HTTP request failed: " . $message, $e->getCode(), $e);
        }
    }
}