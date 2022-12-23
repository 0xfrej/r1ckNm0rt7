<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Request;

use Psr\Http\Message\RequestInterface;

interface IRequestFactory
{
    /**
     * Returns new GET request for given path
     */
    public function createGetRequest(string $path): RequestInterface;

    /**
     * Returns new POST request for given path
     */
    public function createPostRequest(string $path, string $data): RequestInterface;

    /**
     * Returns new PUT request for given path
     */
    public function createPutRequest(string $path, string $data): RequestInterface;

    /**
     * Returns new PATCH request for given path
     */
    public function createPatchRequest(string $path, string $data): RequestInterface;

    /**
     * Returns new DELETE request for given path
     */
    public function createDeleteRequest(string $path): RequestInterface;

    /**
     * Returns new OPTIONS request for given path
     */
    public function createOptionsRequest(string $path): RequestInterface;

    /**
     * Returns new HEAD request for given path
     */
    public function createHeadRequest(string $path): RequestInterface;
}
