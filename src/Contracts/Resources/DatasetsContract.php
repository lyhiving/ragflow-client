<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Datasets\CreateResponse;
use RAGFlow\Responses\Datasets\DeleteResponse;
use RAGFlow\Responses\Datasets\ListResponse;
use RAGFlow\Responses\Datasets\UpdateResponse;

interface DatasetsContract
{
    /**
     * Creates a dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#create-dataset
     */
    public function create(array $parameters): CreateResponse;

    /**
     * Lists the currently available datasets, and provides basic information about each one.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#list-datasets
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * Updates configurations for a specified dataset.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#update-dataset
     */
    public function update(string $datasetId, array $parameters): UpdateResponse;

    /**
     * Deletes datasets by ID.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#delete-datasets
     */
    public function delete(array $parameters): DeleteResponse;
}