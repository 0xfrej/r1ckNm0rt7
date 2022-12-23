<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Api\ApiResult;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class BaseController extends AbstractController
{
    public const COMMON_GROUPS_LIST = ['default'];
    public const COMMON_GROUPS_DETAIL = ['default', 'detail'];

    /**
     * @param array<string>          $groups
     * @param array                  $headers
     */
    protected function jsonResponse(ApiResult $data, array $groups, int $status = 200, array $headers = []): JsonResponse
    {
        $contextBuilder = (new ObjectNormalizerContextBuilder())
            ->withGroups(array_merge(['response'], $groups))
            ->withPreserveEmptyObjects(true);

        return $this->json($data, $status, $headers, $contextBuilder->toArray());
    }
}
