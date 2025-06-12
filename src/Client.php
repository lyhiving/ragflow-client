<?php

namespace lyhiving\ragflow;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use lyhiving\ragflow\Exception\RagflowException;

/**
 * @property Api\Agent $agent
 * @property Api\Chat $chat
 * @property Api\Dataset $dataset
 * @property Api\Document $document
 * @property Api\Chunk $chunk
 * @property Api\Session $session
 */
class Client
{
    protected HttpClient $httpClient;
    protected Config $config;

    public function __construct(string $apiKey, string $apiEndpoint, float $requestTimeout = 30.0)
    {
        $this->config = new Config($apiKey, $apiEndpoint, $requestTimeout);
        $this->httpClient = new HttpClient([
            'base_uri' => rtrim($apiEndpoint, '/') . '/',
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ],
            'timeout' => $requestTimeout,
        ]);
    }

    public function __get(string $name)
    {
        $classMap = [
            'agent' => Api\Agent::class,
            'chat' => Api\Chat::class,
            'dataset' => Api\Dataset::class,
            'document' => Api\Document::class,
            'chunk' => Api\Chunk::class,
            'session' => Api\Session::class,
        ];

        if (array_key_exists($name, $classMap)) {
            return new $classMap[$name]($this);
        }
        throw new \InvalidArgumentException("Invalid API module: {$name}");
    }

    public function get(string $uri, array $params = []): array
    {
        return $this->request('GET', $uri, ['query' => $params]);
    }

    public function post(string $uri, array $data = []): array
    {
        return $this->request('POST', $uri, ['json' => $data]);
    }

    public function put(string $uri, array $data = []): array
    {
        return $this->request('PUT', $uri, ['json' => $data]);
    }

    public function delete(string $uri, array $data = []): array
    {
        return $this->request('DELETE', $uri, ['json' => $data]);
    }

    public function postMultipart(string $uri, array $multipart = []): array
    {
        return $this->request('POST', $uri, ['multipart' => $multipart]);
    }

    public function stream(string $uri, array $data = [], callable $callback = null)
    {
        try {
            $options = ['json' => $data];
            $options['stream'] = true;
            $options['buffer'] = false;
            
            $response = $this->httpClient->post($uri, $options);
            $body = $response->getBody();
            
            while (!$body->eof()) {
                $line = $body->read(1024);
                if ($callback) {
                    $callback($line);
                }
            }
            
            return true;
        } catch (RequestException $e) {
            $message = $e->getMessage();
            if ($e->hasResponse()) {
                $errorData = json_decode((string) $e->getResponse()->getBody(), true);
                $message = $errorData['message'] ?? $message;
            }
            throw new RagflowException("HTTP request failed: " . $message, $e->getCode(), $e);
        }
    }

    public function downloadFile(string $uri, string $savePath): bool
    {
        try {
            $response = $this->httpClient->get($uri, ['sink' => $savePath]);
            return $response->getStatusCode() === 200;
        } catch (RequestException $e) {
            throw new RagflowException("Failed to download file: " . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $response = $this->httpClient->request($method, $uri, $options);
            $data = json_decode((string) $response->getBody(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RagflowException("Invalid JSON response: " . json_last_error_msg());
            }
            
            if (isset($data['code']) && $data['code'] !== 0) {
                throw new RagflowException($data['message'] ?? 'Unknown API error', $data['code']);
            }
            
            return $data;
        } catch (RequestException $e) {
            $message = $e->getMessage();
            if ($e->hasResponse()) {
                $errorData = json_decode((string) $e->getResponse()->getBody(), true);
                $message = $errorData['message'] ?? $message;
                $code = $errorData['code'] ?? $e->getCode();
            } else {
                $code = $e->getCode();
            }
            throw new RagflowException("HTTP request failed: " . $message, $code, $e);
        }
    }

    public function getConfig(): Config
    {
        return $this->config;
    }
}