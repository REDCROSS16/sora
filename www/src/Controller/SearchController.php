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


    #[Route(path:'/search', name:'search', methods: 'GET')]
    public function search(Request $request): JsonResponse
    {
        dd($request->query);
        $searchQuery = [
            'query' => [
                'match' => [
                    'content' => $request->query,
                ],
            ],
        ];

        $results = $this->searchService->search('documents', $searchQuery);

        return new JsonResponse($results);
    }

    /**
     * @return void
     * @phpstan-ignore
     */
    private function getExampleOfSearching(): void
    {
        // Вы можете использовать bool для комбинирования условий
        $searchQuery = [
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['title' => 'Sample']],
                        ['match' => ['content' => 'document']],
                    ],
                ],
            ],
        ];

        $searchQuery = [
            'query' => [
                'bool' => [
                    'must' => [
                        ['match' => ['content' => 'sample']],
                    ],
                    'filter' => [
                        ['range' => ['date' => ['gte' => '2024-01-01']]],
                    ],
                ],
            ],
        ];
    }
}