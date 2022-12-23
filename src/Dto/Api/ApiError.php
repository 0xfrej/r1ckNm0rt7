<?php

declare(strict_types=1);

namespace App\Dto\Api;

use Symfony\Component\Serializer\Annotation\Groups;

class ApiError
{
    #[Groups('response')]
    protected string $message;

    public function __construct(
        string $message
    ) {
        $this->message = $message;
    }

    public static function make(string $message): self
    {
        return new self($message);
    }

    /**
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
