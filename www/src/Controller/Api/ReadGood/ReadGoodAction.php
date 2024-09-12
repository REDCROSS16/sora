<?php declare(strict_types=1);

namespace App\Controller\Api\ReadGood;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
readonly class ReadGoodAction
{
    public function __construct(
        private ReadGoodManager     $manager,
        private SerializerInterface $serializer,
    ) {
    }

    #[Route(path: '/api/goods/{id}', requirements: ['id'=>'\d+'], methods: ['GET'])]
    public function __invoke(int $id): Response
    {
        $result = $this->manager->getGood($id);

        return $result === null
            ? new JsonResponse(['success' => false], Response::HTTP_NOT_FOUND)
            : new JsonResponse($this->serializer
                ->serialize($result, JsonEncoder::FORMAT), Response::HTTP_OK, [], true);
    }
}