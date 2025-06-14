<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\StreamResponse;
use RAGFlow\Responses\Threads\Runs\ThreadRunResponse;
use RAGFlow\Responses\Threads\Runs\ThreadRunStreamResponse;
use RAGFlow\Responses\Threads\ThreadDeleteResponse;
use RAGFlow\Responses\Threads\ThreadResponse;

interface ThreadsContract
{
    /**
     * Create a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#threads/createThread
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): ThreadResponse;

    /**
     * Create a thread and run it in one request.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/createThreadAndRun
     *
     * @param  array<string, mixed>  $parameters
     */
    public function createAndRun(array $parameters): ThreadRunResponse;

    /**
     * Create a thread and run it in one request, returning a stream.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs/createThreadAndRun
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<ThreadRunStreamResponse>
     */
    public function createAndRunStreamed(array $parameters): StreamResponse;

    /**
     * Retrieves a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#threads/getThread
     */
    public function retrieve(string $id): ThreadResponse;

    /**
     * Modifies a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#threads/modifyThread
     *
     * @param  array<string, mixed>  $parameters
     */
    public function modify(string $id, array $parameters): ThreadResponse;

    /**
     * Delete a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#threads/deleteThread
     */
    public function delete(string $id): ThreadDeleteResponse;

    /**
     * Manage messages attached to a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#messages
     */
    public function messages(): ThreadsMessagesContract;

    /**
     * Represents an execution run on a thread.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#runs
     */
    public function runs(): ThreadsRunsContract;
}
