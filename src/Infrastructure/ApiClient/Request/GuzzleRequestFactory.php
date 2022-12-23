<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Request;

use App\Infrastructure\ApiClient\Enum\HttpMethod;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;

/**
 * PSR-7 request factory using GuzzleHttp implementation
 */
class GuzzleRequestFactory implements IRequestFactory
{
    /**
     * @param array<string, string>  $baseHeaders Headers added to every request
     */
    public function __construct(
        protected string $baseUrl,
        protected array $baseHeaders = []
    ) {
    }

    protected function makeRequest(string $method, string $path): Request
    {
        $request = new Request($method, $this->baseUrl . $path);

        foreach ($this->baseHeaders as $header => $value) {
            $request->withHeader($header, $value);
        }

        return $request;
    }

    /**
     * @inheritDoc
     */
    public function createGetRequest(string $path): RequestInterface
    {
        return $this->makeRequest(HttpMethod::GET, $path);
    }

    /**
     * @inheritDoc
     */
    public function createPostRequest(string $path, string $data): RequestInterface
    {
        return $this->makeRequest(HttpMethod::POST, $path)
            ->withBody(Utils::streamFor($data));
    }

    /**
     * @inheritDoc
     */
    public function createPutRequest(string $path, string $data): RequestInterface
    {
        return $this->makeRequest(HttpMethod::PUT, $path);
    }

    /**
     * @inheritDoc
     */
    public function createPatchRequest(string $path, string $data): RequestInterface
    {
        return $this->makeRequest(HttpMethod::PATCH, $path)
            ->withBody(Utils::streamFor($data));
    }

    /**
     * @inheritDoc
     */
    public function createDeleteRequest(string $path): RequestInterface
    {
        return $this->makeRequest(HttpMethod::DELETE, $path);
    }

    /**
     * @inheritDoc
     */
    public function createOptionsRequest(string $path): RequestInterface
    {
        return $this->makeRequest(HttpMethod::OPTIONS, $path);
    }

    /**
     * @inheritDoc
     */
    public function createHeadRequest(string $path): RequestInterface
    {
        return $this->makeRequest(HttpMethod::HEAD, $path);
    }
}
