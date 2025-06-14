<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Moderations\CreateResponse;

interface ModerationsContract
{
    /**
     * Classifies if text violates RAGFlow's Content Policy.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#moderations/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
