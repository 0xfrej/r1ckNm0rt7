<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Api\ApiResult;
use App\Service\RickAndMortyApi\IRickAndMortyFacade;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DimensionController extends BaseController
{
    /**
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\LocationNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    #[Route('/api/dimension/{name}/characters')]
    public function getDimensionCharacters(string $name, IRickAndMortyFacade $rickAndMortyFacade): Response
    {
        $characterList = $rickAndMortyFacade->getCharactersInDimension($name);

        return $this->jsonResponse(
            ApiResult::make($characterList),
            self::COMMON_GROUPS_LIST
        );
    }
}
