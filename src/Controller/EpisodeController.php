<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Api\ApiResult;
use App\Service\RickAndMortyApi\IRickAndMortyFacade;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EpisodeController extends BaseController
{
    /**
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\EpisodeNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    #[Route('/api/episode/{name}/characters')]
    public function getEpisodeCharacters(string $name, IRickAndMortyFacade $rickAndMortyFacade): Response
    {
        $characterList = $rickAndMortyFacade->getCharactersInEpisode($name);

        return $this->jsonResponse(
            ApiResult::make($characterList),
            self::COMMON_GROUPS_LIST
        );
    }
}
