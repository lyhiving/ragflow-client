<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Files\CreateResponse;
use RAGFlow\Responses\Files\DeleteResponse;
use RAGFlow\Responses\Files\ListResponse;
use RAGFlow\Responses\Files\RetrieveResponse;
use RAGFlow\Responses\Files\UpdateResponse;
use RAGFlow\Responses\Files\ParseResponse;

interface FilesContract
{
    /**
     * Upload documents to a specified dataset.
     *
     * @param string $datasetId The ID of the dataset
     * @param array<string, mixed> $parameters The file upload parameters
     * @see https://ragflow.io/docs/dev/http_api_reference#upload-documents
     */
    public function upload(string $datasetId, array $parameters): CreateResponse;

    /**
     * List documents in a specified dataset.
     *
     * @param string $datasetId The ID of the dataset
     * @param array<string, mixed> $parameters Query parameters (page, page_size, orderby, desc, keywords, id, name)
     * @see https://ragflow.io/docs/dev/http_api_reference#list-documents
     */
    public function list(string $datasetId, array $parameters = []): ListResponse;

    /**
     * Download a document from a specified dataset.
     *
     * @param string $datasetId The ID of the dataset
     * @param string $documentId The ID of the document
     * @see https://ragflow.io/docs/dev/http_api_reference#download-document
     */
    public function download(string $datasetId, string $documentId): string;

    /**
     * Update configurations for a specified document.
     *
     * @param string $datasetId The ID of the dataset
     * @param string $documentId The ID of the document
     * @param array<string, mixed> $parameters Update parameters
     * @see https://ragflow.io/docs/dev/http_api_reference#update-document
     */
    public function update(string $datasetId, string $documentId, array $parameters): UpdateResponse;

    /**
     * Delete documents from a dataset.
     *
     * @param string $datasetId The ID of the dataset
     * @param array<string, mixed> $parameters The document IDs to delete
     * @see https://ragflow.io/docs/dev/http_api_reference#delete-documents
     */
    public function delete(string $datasetId, array $parameters): DeleteResponse;

    /**
     * Parse documents in a dataset.
     *
     * @param string $datasetId The ID of the dataset
     * @param array<string, array<string>> $parameters The document IDs to parse
     * @see https://ragflow.io/docs/dev/http_api_reference#parse-documents
     */
    public function parse(string $datasetId, array $parameters): ParseResponse;

    /**
     * Stop parsing documents.
     *
     * @param string $datasetId The ID of the dataset
     * @param array<string, array<string>> $parameters The document IDs to stop parsing
     * @see https://ragflow.io/docs/dev/http_api_reference#stop-parsing-documents
     */
    public function stopParse(string $datasetId, array $parameters): ParseResponse;
}