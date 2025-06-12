<?php

namespace lyhiving\ragflow\Api;

use lyhiving\ragflow\Client;

abstract class BaseApi
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}