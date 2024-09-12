<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\SearchServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    public function __construct(readonly private SearchServiceInterface $searchService)
    {
    }

    #[Route(path:'/search', name:'search', methods: 'GET')]
    public function search(Request $request): JsonResponse
    {
        $params = [...$request->query];

        return new JsonResponse( $this->searchService->search($params));
    }


    #[Route('/create-index', methods: 'POST')]
    public function createIndex(): JsonResponse
    {
        $index = 'my_index';

        $settings = [
            'settings' => [
                'number_of_shards' => 1,
                'number_of_replicas' => 0,
            ],
            'mappings' => [
                'properties' => [
                    'title' => ['type' => 'text'],
                    'content' => ['type' => 'text'],
                    'date' => ['type' => 'date'],
                ],
            ],
        ];

        $response = $this->searchService->createIndex($index, $settings);

        return new JsonResponse($response);
    }
}