<?php

return [
    'base_url' => env('RAGFLOW_BASE_URL', 'http://127.0.0.1:8001/v1'),
    'api_key' => env('RAGFLOW_API_KEY'),
    'timeout' => env('RAGFLOW_TIMEOUT', 30.0),
];