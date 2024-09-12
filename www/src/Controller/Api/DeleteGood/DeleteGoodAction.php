<?php declare(strict_types=1);

namespace App\Controller\Api\DeleteGood;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
readonly class DeleteGoodAction
{
    public function __construct(
        private DeleteGoodManager $manager,
    ) {
    }

    #[Route(path: '/api/goods/{id}', requirements: ['id'=>'\d+'], methods: ['DELETE'])]
    public function __invoke(int $id): Response
    {
        $result = $this->manager->deleteGood($id);

        return $result
            ? new JsonResponse(['success' => true])
            : new JsonResponse(['success' => false], Response::HTTP_NOT_FOUND);
    }
}