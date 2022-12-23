<?php

declare(strict_types=1);

namespace App\Factory;

use App\Infrastructure\ApiClient\AdapterInterface;
use App\Infrastructure\ApiClient\GuzzleAdapter;
use App\Infrastructure\ApiClient\Request\GuzzleRequestFactory;
use App\Infrastructure\ApiClient\Request\IRequestFactory;
use GuzzleHttp\Client;

final class RickAndMortyApiFactory
{
    public function createRequestFactory(string $baseUrl): IRequestFactory
    {
        return new GuzzleRequestFactory($baseUrl);
    }

    public function createAdapter(): AdapterInterface
    {
        return new GuzzleAdapter(new Client());
    }
}
