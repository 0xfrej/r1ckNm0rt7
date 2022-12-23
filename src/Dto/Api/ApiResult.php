<?php

declare(strict_types=1);

namespace App\Dto\Api;

use Symfony\Component\Serializer\Annotation\Groups;

class ApiResult
{
    /**
     * @var array<object>|object|null
     */
    #[Groups('response')]
    protected array|object|null $data;

    /**
     * @var array<ApiError>|null
     */
    #[Groups('response')]
    protected ?array $errors;

    #[Groups('response')]
    protected ?ApiLinks $links;

    /**
     * @param array<object>|object|null  $data
     * @param array<ApiError>|null       $errors
     */
    public function __construct(object|array|null $data, ?array $errors, ?ApiLinks $links)
    {
        $this->data = $data;
        $this->errors = $errors;
        $this->links = $links;

        if ($this->data === null && $this->errors === null) {
            $this->errors = [ApiError::make("Unknown error")];
        }
    }


    /**
     * @param object|array<object>|null  $data
     * @param array<ApiError>|null       $errors
     * @return static
     */
    public static function make(
        object|array|null $data = null,
        ?array $errors = null,
        ?ApiLinks $links = null
    ): self {
        return new self($data, $errors, $links);
    }

    /**
     * @return array<object>|object|null
     */
    public function getData(): object|array|null
    {
        return $this->data;
    }

    /**
     * @return array<\App\Dto\Api\ApiError>|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     */
    public function getLinks(): ?ApiLinks
    {
        return $this->links;
    }
}
