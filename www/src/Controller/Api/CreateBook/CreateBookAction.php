<?php declare(strict_types=1);

namespace App\Controller\Api\CreateBook;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
readonly class CreateBookAction
{
    public function __construct(
        private CreateBookManager $manager,
    ) {
    }

    #[Route(path: '/api/books', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        return new JsonResponse(['id' => $this->manager->createBook($request)]);
    }
}