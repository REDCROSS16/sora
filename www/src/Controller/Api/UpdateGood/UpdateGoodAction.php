<?php

namespace App\Controller\Api\UpdateGood;

use App\Controller\Api\UpdateGood\Input\UpdateGoodRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
readonly class UpdateGoodAction
{
    public function __construct(
        private UpdateGoodManager $manager,
    ) {
    }

    #[Route(path: '/api/goods', methods: ['PATCH'])]
    public function __invoke(#[MapRequestPayload] UpdateGoodRequest $request): Response
    {
        $result = $this->manager->updateGood($request);

        return $result
            ? new JsonResponse(['success' => true])
            : new JsonResponse(['success' => false], Response::HTTP_NOT_FOUND);
    }
}