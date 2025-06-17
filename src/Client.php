<?php

declare (strict_types = 1);

namespace RAGFlow;

use Jenssegers\Agent\Facades\Agent;
use RAGFlow\Contracts\ClientContract;
use RAGFlow\Contracts\TransporterContract;
use RAGFlow\Resources\Assistants;
use RAGFlow\Resources\Agents;
use RAGFlow\Resources\Sessions;
use RAGFlow\Resources\Chats;
use RAGFlow\Resources\Completions;
use RAGFlow\Resources\Files;
use RAGFlow\Resources\Chunks;
use RAGFlow\Resources\Datasets;


final class Client implements ClientContract
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }

    /**
     * CHAT ASSISTANT MANAGEMENT
     * 
     * Build assistants that can call models and use tools to perform tasks.
     *
     * @see https://ragflow.server/user-setting/api#create-chat-assistant
     */
    public function assistants(): Assistants
    {
        return new Assistants($this->transporter);
    }

    /**
     * SESSION MANAGEMENT
     *
     */
    public function agents(): Agents
    {
        return new Agents($this->transporter);
    }
    
    /**
     * Converse with chat assistant
     * 
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#completions
     */
    public function completions(): Completions
    {
        return new Completions($this->transporter);
    }

    /**
     * Given a chat conversation, the model will return a chat completion response.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#chat
     */
    public function chats(): Chats
    {
        return new Chats($this->transporter);
    }
    

    /**
     * Files are used to upload documents that can be used with features like Fine-tuning.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#files
     */
    public function files(): Files
    {
        return new Files($this->transporter);
    }

    public function chunks(): Chunks
    {
        return new Chunks($this->transporter);
    }

    /**
     * List and describe the various models available in the API.
     *
     * @see https://ragflow.io/docs/dev/http_api_reference#models
     */
    public function datasets(): Datasets
    {
        return new Datasets($this->transporter);
    }
   
}
