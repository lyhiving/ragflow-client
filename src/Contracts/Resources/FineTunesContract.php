<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\FineTunes\ListEventsResponse;
use RAGFlow\Responses\FineTunes\ListResponse;
use RAGFlow\Responses\FineTunes\RetrieveResponse;
use RAGFlow\Responses\FineTunes\RetrieveStreamedResponseEvent;
use RAGFlow\Responses\StreamResponse;

interface FineTunesContract
{
    /**
     * Creates a job that fine-tunes a specified model from a given dataset.
     *
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#fine-tunes/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): RetrieveResponse;

    /**
     * List your organization's fine-tuning jobs.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#fine-tunes/list
     */
    public function list(): ListResponse;

    /**
     * Gets info about the fine-tune job.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#fine-tunes/list
     */
    public function retrieve(string $fineTuneId): RetrieveResponse;

    /**
     * Immediately cancel a fine-tune job.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#fine-tunes/cancel
     */
    public function cancel(string $fineTuneId): RetrieveResponse;

    /**
     * Get fine-grained status updates for a fine-tune job.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#fine-tunes/events
     */
    public function listEvents(string $fineTuneId): ListEventsResponse;

    /**
     * Get streamed fine-grained status updates for a fine-tune job.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#fine-tunes/events
     *
     * @return StreamResponse<RetrieveStreamedResponseEvent>
     */
    public function listEventsStreamed(string $fineTuneId): StreamResponse;
}
