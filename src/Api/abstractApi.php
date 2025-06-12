<?php
namespace lyhiving\ragflow\Api;
use lyhiving\ragflow\client;
abstract class abstractApi {
    protected client $client;
    public function __construct(client $client) { $this->client = $client; }
}