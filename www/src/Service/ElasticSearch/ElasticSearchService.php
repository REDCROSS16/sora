<?php declare(strict_types=1);

namespace App\Service\ElasticSearch;
use App\Service\SearchServiceInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Http\Promise\Promise;
use Symfony\Component\HttpFoundation\Request;

class ElasticSearchService implements SearchServiceInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param string $index
     * @param array $settings
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function createIndex(string $index, array $settings = []): Elasticsearch|Promise
    {
        $params = [
            'index' => $index,
            'body' => [
                'mappings' => [
                    'properties' => [
                        'title' => ['type' => 'text'],
                        'published_date' => ['type' => 'date'],
                        'views' => ['type' => 'integer'],
                    ],
                ],
            ],
        ];

        return $this->client->indices()->create($params);
    }

    /**
     * @param array $params
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function search(array $params = []): Elasticsearch|Promise
    {
        return $this->client->search($params);
    }

    /**
     * @param Request $request
     * @param ElasticSearchQueryBuilder $builder
     * @return array
     */
    public function searchWithBuilder(Request $request, ElasticSearchQueryBuilder $builder): array
    {
        return $builder
            ->match('title', 'Elasticsearch')
            ->filter('status', 'active')
            ->sort('created_at', 'desc')
            ->size(10)
            ->from(0)
            ->aggregate([])
            ->get();
    }

    /**
     * @param string $index
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function aggregateData(string $index): Elasticsearch|Promise
    {
        $params = [
            'index' => $index,
            'body' => [
                'size' => 0, // Не возвращаем документы
                'aggs' => [
                    'average_views' => [
                        'avg' => ['field' => 'views'],
                    ],
                    'views_per_title' => [
                        'terms' => ['field' => 'title'],
                    ],
                ],
            ],
        ];

        return $this->client->search($params);
    }

    /**
     * @param string $index
     * @param string $id
     * @param array $document
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function indexDocument(string $index, string $id, array $document): Elasticsearch|Promise
    {
        return $this->client->index([
            'index' => $index,
            'body' => $document,
        ]);
    }
}