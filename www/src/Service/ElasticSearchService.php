<?php declare(strict_types=1);

namespace App\Service;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Http\Promise\Promise;

class ElasticSearchService implements SearchServiceInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
    }

    /**
     * @param string $index
     * @param array $settings
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function createIndex(string $index, array $settings): Elasticsearch|Promise
    {
        return $this->client->indices()->create([
            'index' => $index,
            'body' => $settings,
        ]);
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

    /**
     * @param string $index
     * @param array $query
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws ServerResponseException
     */
    public function search(string $index, array $query): Elasticsearch|Promise
    {
        return $this->client->search([
            'index' => $index,
            'body' => $query,
        ]);
    }
}