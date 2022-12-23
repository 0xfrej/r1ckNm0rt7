<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Api\ApiResult;
use App\Service\RickAndMortyApi\IRickAndMortyFacade;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CharacterController extends BaseController
{
    /**
     * Get character detail by it's id
     *
     * @throws \App\Service\RickAndMortyApi\ApiClient\Exception\CharacterNotFoundException
     * @throws \App\Infrastructure\ApiClient\Exception\ApiClientException
     */
    #[Route('/api/character/{id}')]
    public function getCharacter(int $id, IRickAndMortyFacade $rickAndMortyService): Response
    {
        $character = $rickAndMortyService->getCharacterById($id);

        return $this->jsonResponse(
            ApiResult::make($character),
            self::COMMON_GROUPS_DETAIL
        );
    }
}
