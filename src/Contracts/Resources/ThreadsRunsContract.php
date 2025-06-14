<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\StreamResponse;
use RAGFlow\Responses\Threads\Runs\ThreadRunListResponse;
use RAGFlow\Responses\Threads\Runs\ThreadRunResponse;
use RAGFlow\Responses\Threads\Runs\ThreadRunStreamResponse;

interface ThreadsRunsContract
{
    /**
     * Create a run.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $threadId, array $parameters): ThreadRunResponse;

    /**
     * Create a streamed run.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/createRun
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function createStreamed(string $threadId, array $parameters): StreamResponse;

    /**
     * Retrieves a run.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/getRun
     */
    public function retrieve(string $threadId, string $runId): ThreadRunResponse;

    /**
     * Modifies a run.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/modifyRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $threadId, string $runId, array $parameters): ThreadRunResponse;

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/submitToolOutputs
     *
     * @param  array<string, mixed>  $parameters
     */
    public function submitToolOutputs(string $threadId, string $runId, array $parameters): ThreadRunResponse;

    /**
     * This endpoint can be used to submit the outputs from the tool calls once they're all completed.
     * And stream back the response
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/submitToolOutputs
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function submitToolOutputsStreamed(string $threadId, string $runId, array $parameters): StreamResponse;

    /**
     * Cancels a run that is `in_progress`.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/cancelRun
     */
    public function cancel(string $threadId, string $runId): ThreadRunResponse;

    /**
     * Returns a list of runs belonging to a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/listRuns
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, array $parameters = []): ThreadRunListResponse;

    /**
     * Get steps attached to a run.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/step-object
     */
    public function steps(): ThreadsRunsStepsContract;
}
