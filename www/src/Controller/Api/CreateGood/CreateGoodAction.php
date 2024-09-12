<?php declare(strict_types=1);

namespace App\Controller\Api\CreateGood;

use App\Controller\Api\CreateGood\Input\CreateGoodRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
readonly class CreateGoodAction
{
    public function __construct(
        private CreateGoodManager $manager,
    ) {
    }

    #[Route(path: '/api/goods', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreateGoodRequest $request): Response
    {
        return new JsonResponse(['id' => $this->manager->createGood($request)]);
    }
}