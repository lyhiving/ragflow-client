<?php

namespace lyhiving\ragflow;

class Config
{
    private string $apiKey;
    private string $apiEndpoint;
    private float $requestTimeout;

    public function __construct(string $apiKey, string $apiEndpoint, float $requestTimeout = 30.0)
    {
        $this->apiKey = $apiKey;
        $this->apiEndpoint = rtrim($apiEndpoint, '/');
        $this->requestTimeout = $requestTimeout;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    public function getRequestTimeout(): float
    {
        return $this->requestTimeout;
    }
}