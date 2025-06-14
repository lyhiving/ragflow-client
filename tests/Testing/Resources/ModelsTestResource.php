<?php

use RAGFlow\Resources\Models;
use RAGFlow\Responses\Models\DeleteResponse;
use RAGFlow\Responses\Models\ListResponse;
use RAGFlow\Responses\Models\RetrieveResponse;
use RAGFlow\Testing\ClientFake;

it('records a model retrieve request', function () {
    $fake = new ClientFake([
        RetrieveResponse::fake(),
    ]);

    $fake->datasets()->retrieve('gpt-3.5-turbo-instruct');

    $fake->assertSent(Models::class, function ($method, $parameters) {
        return $method === 'retrieve' &&
            $parameters === 'gpt-3.5-turbo-instruct';
    });
});

it('records a model delete request', function () {
    $fake = new ClientFake([
        DeleteResponse::fake(),
    ]);

    $fake->datasets()->delete('curie:ft-acmeco-2021-03-03-21-44-20');

    $fake->assertSent(Models::class, function ($method, $parameters) {
        return $method === 'delete' &&
            $parameters === 'curie:ft-acmeco-2021-03-03-21-44-20';
    });
});

it('records a model list request', function () {
    $fake = new ClientFake([
        ListResponse::fake(),
    ]);

    $fake->datasets()->list();

    $fake->assertSent(Models::class, function ($method) {
        return $method === 'list';
    });
});
