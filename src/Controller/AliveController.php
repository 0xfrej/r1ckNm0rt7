<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AliveController
{
    #[Route('/')]
    public function isAlive(): Response
    {
        return new JsonResponse([
            'status' => 'OK',
            'ack' => (new \DateTime())->getTimestamp(),
        ]);
    }
}
