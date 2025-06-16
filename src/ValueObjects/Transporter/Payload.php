<?php

declare(strict_types=1);

namespace RAGFlow\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use RAGFlow\Contracts\Request;
use RAGFlow\Enums\Transporter\ContentType;
use RAGFlow\Enums\Transporter\Method;
use RAGFlow\ValueObjects\ResourceUri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @internal
 */
final class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = [],
    ) {
        // ..
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function list(string $resource, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function retrieve(string $resource, string $id, string $suffix = '', array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieve($resource, $id, $suffix);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function modify(string $resource, string $id, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::PUT;
        $uri = ResourceUri::modify($resource, $id);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieveContent(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieveContent($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function create(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    /**
     * Creates a new Payload value object for uploading documents.
     *
     * @param string $resource The resource URI
     * @param array<string, mixed> $parameters The upload parameters
     */
    public static function upload(string $resource, array $parameters): self
    {
        $contentType = ContentType::MULTIPART;
        $method = Method::POST;
        $uri = ResourceUri::upload($resource);

        // dd([$contentType, $method, $uri, $parameters]);
        return new self($contentType, $method, $uri, $parameters);
    }

     /**
     * Creates a new Payload value object for parsing documents.
     *
     * @param string $resource The resource URI
     * @param array<string, mixed> $parameters The document IDs to parse
     */
    public static function parse(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object for stopping document parsing.
     *
     * @param string $resource The resource URI
     * @param array<string, mixed> $parameters The document IDs to stop parsing
     */
    public static function stopParse(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        $uri = ResourceUri::delete($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function cancel(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::cancel($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object for deleting a single resource.
     */
    public static function delete(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        // $parameters = is_string($id) ? ['ids' => [$id]] : (isset($id['ids']) ? $id : ['ids' => $id]);
        $uri = ResourceUri::delete($resource);
        return new self($contentType, $method, $uri, $parameters);
    }


    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory;

        $body = null;

        $uri = $baseUri->toString() . $this->uri->toString();

        $queryParams = $queryParams->toArray();
        if ($this->method === Method::GET) {
            $queryParams = [...$queryParams, ...$this->parameters];
        }

        if ($queryParams !== []) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $headers = $headers->withContentType($this->contentType);

        // 处理请求体
        if (in_array($this->method, [Method::POST, Method::PUT, Method::DELETE])) {
            if ($this->contentType === ContentType::MULTIPART) {
                // 处理 multipart/form-data
                // 由于 MultipartStreamBuilder 可能无法完全兼容 CURLFile，手动构建 multipart/form-data
                $boundary = '--------------------------' . microtime(true) . rand(100000, 999999);
                $eol = "\r\n";
                $bodyContent = '';

                foreach ($this->parameters as $name => $value) {
                    if ($value instanceof \CURLFile) {
                        $filename = $value->getPostFilename() ?: basename($value->getFilename());
                        $mimeType = $value->getMimeType() ?: 'application/octet-stream';
                        $fileContent = file_get_contents($value->getFilename());
                        $bodyContent .= '--' . $boundary . $eol;
                        $bodyContent .= 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $filename . '"' . $eol;
                        $bodyContent .= 'Content-Type: ' . $mimeType . $eol . $eol;
                        $bodyContent .= $fileContent . $eol;
                    } else {
                        $bodyContent .= '--' . $boundary . $eol;
                        $bodyContent .= 'Content-Disposition: form-data; name="' . $name . '"' . $eol . $eol;
                        $bodyContent .= $value . $eol;
                    }
                }
                $bodyContent .= '--' . $boundary . '--' . $eol;

                $body = $psr17Factory->createStream($bodyContent);

                // 需要手动设置 Content-Type
                $headers = $headers->withoutContentType()->withHeader('Content-Type', 'multipart/form-data; boundary=' . $boundary);
                // $headers = $headers->withoutContentType(); // 让 MultipartStreamBuilder 设置正确的 Content-Type
            } else {
                // 处理 JSON 数据
                $jsonData = json_encode($this->parameters, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
                $body = $psr17Factory->createStream($jsonData);
            }
        }

        $request = $psr17Factory->createRequest($this->method->value, $uri);

        if ($body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}