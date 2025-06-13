<?php

use RAGFlow\Resources\Batches;
use RAGFlow\Resources\Completions;
use RAGFlow\Resources\Models;

it('has models', function () {
    $openAI = RAGFlow::client('foo');

    expect($openAI->datasets())->toBeInstanceOf(Models::class);
});

it('has completions', function () {
    $openAI = RAGFlow::client('foo');

    expect($openAI->completions())->toBeInstanceOf(Completions::class);
});

it('has batches', function () {
    $openAI = RAGFlow::client('foo');

    expect($openAI->batches())->toBeInstanceOf(Batches::class);
});
