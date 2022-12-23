<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiClient\Response;

class Response implements IResponse
{
    public function __construct(
        protected bool $isError,
        protected int $httpCode
    ) {
    }

    /**
     * @inheritDoc
     */
    public function isError(): bool
    {
        return $this->isError;
    }

    /**
     * @inheritDoc
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }
}
