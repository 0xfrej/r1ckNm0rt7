<?php

declare(strict_types=1);

namespace App\Dto\Api;

use Symfony\Component\Serializer\Annotation\Groups;

class ApiLinks
{
    #[Groups('response')]
    protected ?ApiPagination $pagination;

    public function __construct(
        ?ApiPagination $pagination
    ) {
        $this->pagination = $pagination;
    }

    public static function make(?ApiPagination $pagination = null): self
    {
        return new self($pagination);
    }

    public function getPagination(): ?ApiPagination
    {
        return $this->pagination;
    }
}
