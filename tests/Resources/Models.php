<?php

use RAGFlow\Responses\Meta\MetaInformation;
use RAGFlow\Responses\Models\DeleteResponse;
use RAGFlow\Responses\Models\ListResponse;
use RAGFlow\Responses\Models\RetrieveResponse;

test('list', function () {
    $client = mockClient('GET', 'datasets', [], \RAGFlow\ValueObjects\Transporter\Response::from(modelList(), metaHeaders()));

    $result = $client->datasets()->list();

    expect($result)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class);

    expect($result->data[0])
        ->id->toBe('text-babbage:001');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'models/da-vince', [], \RAGFlow\ValueObjects\Transporter\Response::from(model(), metaHeaders()));

    $result = $client->datasets()->retrieve('da-vince');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('text-babbage:001')
        ->object->toBe('model')
        ->created->toBe(1642018370)
        ->ownedBy->toBe('ragflow');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete fine tuned model', function () {
    $client = mockClient('DELETE', 'models/curie:ft-acmeco-2021-03-03-21-44-20', [], \RAGFlow\ValueObjects\Transporter\Response::from(fineTunedModelDeleteResource(), metaHeaders()));

    $result = $client->datasets()->delete('curie:ft-acmeco-2021-03-03-21-44-20');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('curie:ft-acmeco-2021-03-03-21-44-20')
        ->object->toBe('model')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
