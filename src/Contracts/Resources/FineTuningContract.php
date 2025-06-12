<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\FineTuning\ListJobEventsResponse;
use RAGFlow\Responses\FineTuning\ListJobsResponse;
use RAGFlow\Responses\FineTuning\RetrieveJobResponse;

interface FineTuningContract
{
    /**
     * Creates a job that fine-tunes a specified model from a given dataset.
     *
     * Response includes details of the enqueued job including job status and the name of the fine-tuned models once complete.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function createJob(array $parameters): RetrieveJobResponse;

    /**
     * List your organization's fine-tuning jobs.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning/undefined
     *
     * @param  array<string, mixed>  $parameters
     */
    public function listJobs(array $parameters = []): ListJobsResponse;

    /**
     * Get info about a fine-tuning job.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning/retrieve
     */
    public function retrieveJob(string $jobId): RetrieveJobResponse;

    /**
     * Immediately cancel a fine-tune job.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning/cancel
     */
    public function cancelJob(string $jobId): RetrieveJobResponse;

    /**
     * Get status updates for a fine-tuning job.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning/list-events
     *
     * @param  array<string, mixed>  $parameters
     */
    public function listJobEvents(string $jobId, array $parameters = []): ListJobEventsResponse;
}
